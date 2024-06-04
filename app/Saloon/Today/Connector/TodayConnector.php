<?php
declare(strict_types=1);
namespace App\Saloon\Today\Connector;


use Saloon\Http\Connector;
use Saloon\Traits\Plugins\HasTimeout;

final class TodayConnector extends Connector
{
    use HasTimeout;

    public function resolveBaseUrl(): string
    {
        return 'https://api.todayintel.com';
    }

    function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

}
