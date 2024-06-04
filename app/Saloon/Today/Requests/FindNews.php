<?php
declare(strict_types=1);

namespace App\Saloon\Today\Requests;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;


final class FindNews extends Request implements Cacheable,HasBody
{
    use HasCaching;

    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(private readonly string $keyword)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/google/news/search';
    }

    final function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(Cache::store('file'));
    }

    public function cacheExpiryInSeconds(): int
    {
        //increase to 6 hours
        return 21600;
    }

    final function defaultBody(): array
    {
        return [
            'topic' => $this->keyword,
        ];
    }


    /**
     * @throws \JsonException
     */
    final function createDtoFromResponse(Response|\Saloon\Contracts\Response $response): Collection
    {
        $data = $response->json();

        return collect($data["data"]);
    }

}
