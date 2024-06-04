<?php
declare(strict_types=1);
namespace App\Saloon\Git\Connector;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\HasTimeout;

class GitConnector extends Connector
{
    protected int $connectTimeout = 60;

    protected int $requestTimeout = 120;

    protected string $token;

    use HasTimeout;

    protected string $baseUrl = 'https://api.github.com';

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->token = config('services.github.token') ?? throw new \RuntimeException('No git token provided');
    }


    final function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    final function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/vnd.github.v3+json',
        ];
    }

}
