<?php
declare(strict_types=1);
namespace App\Saloon\Git;
use App\Data\DTO\Article;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

interface GitContract
{

    public function createFile(Article $article): Collection;

    public function createIssue(Data $article): Collection;

    public function createPullRequest(Data $article): Collection;

}
