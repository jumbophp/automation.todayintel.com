<?php

namespace App\Commands;

use App\Domain\Agents\SocialAgent;
use App\Domain\Automation\GumboAI;
use App\Saloon\Git\GitContract;
use App\Saloon\Today\TodayIntelContract;
use App\View\Template;
use Illuminate\Console\Command;

class GithubOpenPullRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open a pull request on Github';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        protected readonly GitContract $contract,
        protected readonly GumboAI $ai
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(TodayIntelContract $today)
    {


    }
}
