<?php
declare(strict_types=1);
namespace App\Saloon\Today;

use App\Data\DTO\Article;
use Illuminate\Support\Collection;

interface TodayIntelContract
{
    public function extract(string $url):Article;

    public function findNews(string $keyword):Collection;
}
