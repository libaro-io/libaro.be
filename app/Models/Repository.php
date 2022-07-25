<?php

namespace App\Models;

use stdClass;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Repository
{
    public string $name;
    public string $url;
    public ?string $description;
    public array $topics;
    public ?string $language;
    public string $releasesUrl;
    public string $defaultBranch;
    public Carbon $lastUpdated;
    public int $numberOfWatchers;
    public int $numberOfOpenIssues;
    public Collection $releases;
    public Documentation $documentation;

    #[Pure] public static function new(): Repository
    {
        return new self;
    }

    public function slug(): string
    {
        return Str::slug($this->name);
    }

    public function lastRelease(): string
    {
        return $this->releases[0]->version ?? 0;
    }

    public function isPrerelease()
    {
        return optional($this->releases->first())->isPrerelease ?? true;
    }

    public function name(string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    public function url(string $html_url): self
    {
        $this->url = $html_url;

        return $this;
    }

    public function description(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function topics(array $topics): self
    {
        $this->topics = $topics;

        return $this;
    }

    public function numberOfWatchers(string|int $watchers): self
    {
        $this->numberOfWatchers = (int)$watchers;

        return $this;
    }

    public function numberOfOpenIssues(string|int $open_issues): self
    {
        $this->numberOfOpenIssues = $open_issues;

        return $this;
    }

    public function language(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function releasesUrl(string $releases_url): self
    {
        $this->releasesUrl = $releases_url;

        return $this;
    }

    public function defaultBranch(string $default_branch): self
    {
        $this->defaultBranch = $default_branch;

        return $this;
    }

    public function lastUpdated(string $updated_at): self
    {
        $this->lastUpdated = Carbon::parse($updated_at);

        return $this;
    }

    public function releases(Collection $releases): self
    {
        $this->releases = $releases;

        return $this;
    }

    public function documentation(Documentation $documentation): self
    {
        $this->documentation = $documentation;

        return $this;
    }

    public function getFile($path)
    {
        return $this->documentation->items->first(function($item) use ($path) {
            return $item->path === $path;
        });
    }

    #[Pure] public function documentationMenu(): Collection
    {
        return $this->documentation->getMenu();
    }

    public function take(array $attributes): stdClass
    {
        $obj = new stdClass();

        foreach ($attributes as $attribute) {
            $obj->$attribute = $this->getAttribute($attribute);
        }

        return $obj;
    }

    private function getAttribute(mixed $attribute)
    {
        if(property_exists($this, $attribute)) {
            return $this->$attribute;
        }

        return $this->$attribute();
    }
}
