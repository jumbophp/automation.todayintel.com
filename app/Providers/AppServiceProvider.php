<?php
declare(strict_types=1);
namespace App\Providers;

use App\Domain\Automation\GumboAI;
use App\Saloon\Cloudflare\CloudflareAIService;
use App\Saloon\Git\GitContract;
use App\Saloon\Git\GitService;
use App\Saloon\Today\TodayIntelContract;
use App\Saloon\Today\TodayIntelContractService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TodayIntelContract::class, TodayIntelContractService::class);
        $this->app->bind(GitContract::class, GitService::class);
        $this->app->bind(GumboAI::class, CloudflareAIService::class);
        $this->app->bind(ClientInterface::class, Client::class);        //github

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
