<?php
declare(strict_types=1);
namespace App\Saloon\Cloudflare\Connector;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\HasTimeout;

class CloudflareConnector extends Connector
{
    protected int $connectTimeout = 120;

    protected int $requestTimeout = 120;

    protected string $account;

    protected string $token;

    use HasTimeout;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->account = config('services.cloudflare.account') ?? throw new \Exception("Cloudflare account not set");
        $this->token = config('services.cloudflare.token') ?? throw new \Exception("Cloudflare token not set");
    }


    final function resolveBaseUrl(): string
    {
        return 'https://api.cloudflare.com/client/v4/accounts/' . $this->account;
    }

    final function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->token
        ];
    }

}
