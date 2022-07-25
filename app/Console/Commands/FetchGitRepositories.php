<?php

namespace App\Console\Commands;

use Exception;
use App\Services\Github;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FetchGitRepositories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:getRepositories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and cache all Libaro open source repositories from Github';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $repositories = Github::getRepositories();
        try {
            Cache::forget('repositories');
            Github::getRepositories();
        } catch (Exception $exception) {
            info('FetchGitRepositories command: Error fetching repositories from Github');
            info($exception->getMessage());

            Cache::put('repositories', $repositories);
        }

        return 0;
    }
}
