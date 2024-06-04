<?php
declare(strict_types=1);
namespace App\Saloon\Today;

use App\Data\DTO\Article;
use App\Saloon\Today\Connector\TodayConnector;
use App\Saloon\Today\Requests\ExtractArticle;
use App\Saloon\Today\Requests\FindNews;
use Illuminate\Support\Collection;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

readonly class TodayIntelContractService implements TodayIntelContract
{
    //constructor
    public function __construct(private TodayConnector $connector)
    {
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function extract(string $url): Article
    {
        $request = new ExtractArticle($url);

        return $this->connector->send($request)->dtoOrFail();

    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function findNews(string $keyword): Collection
    {
        $keyword = new FindNews($keyword);

        $response = $this->connector->send($keyword);

        return $response->dtoOrFail();

    }
}
