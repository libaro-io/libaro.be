<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Release;
use App\Models\Repository;
use App\Models\Documentation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\GithubFetchException;
use GuzzleHttp\Exception\GuzzleException;

class Github
{
    /**
     */
    public static function getRepositories()
    {
        return Cache::rememberForever('repositories', function () {
            $repos = self::makeRequest('https://api.github.com/orgs/libaro-io/repos');

            $repositories = new Collection();

            foreach (json_decode($repos) as $repo) {
                $repository = Repository::new()
                    ->name($repo->name)
                    ->url($repo->html_url)
                    ->description($repo->description)
                    ->topics($repo->topics)
                    ->numberOfWatchers($repo->watchers)
                    ->numberOfOpenIssues($repo->open_issues)
                    ->language($repo->language)
                    ->releasesUrl($repo->releases_url)
                    ->defaultBranch($repo->default_branch)
                    ->lastUpdated($repo->updated_at);

                $repositories->add($repository);
            }

            foreach ($repositories as $repository) {
                $repository
                    ->releases(self::releases($repository))
                    ->documentation(self::getDocumentation($repository));
            }

            return $repositories;
        });

    }

    /**
     * @throws GithubFetchException
     */
    public static function releases(Repository $repository): Collection
    {
        $items = self::makeRequest(str_replace('{/id}', '', $repository->releasesUrl));

        $releases = new Collection();

        foreach (json_decode($items) as $item) {
            $release = Release::new()
                ->version($item->tag_name)
                ->name($item->name)
                ->isPrerelease($item->prerelease);

            $releases->add($release);
        }

        return $releases;
    }

    /**
     * @throws GithubFetchException
     */
    public static function getDocumentation(Repository $repository): Documentation
    {
        if (config('libaro.github.test')) {
            $repositoryFilesOverview = File::get(app_path('/Mocks/github.json'));
        } else {
            $repositoryFilesOverview = self::makeRequest("https://api.github.com/repos/libaro-io/$repository->name/git/trees/$repository->defaultBranch?recursive=1");
        }

        $documentation = Documentation::new()
            ->setItems(json_decode($repositoryFilesOverview));

        if (config('libaro.github.test')) {
            return $documentation;
        }

        foreach ($documentation->items as $item) {
            $file = self::makeRequest("https://raw.githubusercontent.com/libaro-io/$repository->name/$repository->defaultBranch/$item->path");

            $documentation->addFileToPath($item, $file);
        }

        return $documentation;
    }

    /**
     * @throws GithubFetchException
     */
    protected static function makeRequest(string $url): string
    {
        try {
            $client = new Client();
            $result = $client->request(
                'GET',
                $url,
                ['headers' => [
                    'Authorization' => 'token ' . config('libaro.github.access_token'),
                ]]
            );

            return (string)$result->getBody();
        } catch (GuzzleException $exception) {
            info("Github::makeRequest  {$exception->getMessage()}");

            throw new GithubFetchException("Error while making Github request");
        }
    }
}
