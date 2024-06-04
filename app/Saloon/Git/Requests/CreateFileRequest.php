<?php
declare(strict_types=1);
namespace App\Saloon\Git\Requests;


use App\Data\DTO\Article;
use Saloon\Http\Request;
use Saloon\Enums\Method;

class CreateFileRequest extends Request
{
    protected Method $method = Method::POST;

    protected string $owner = "gumbophp";
    protected string $repo = "lzomedia.com";

    protected string $branch = "master";

    protected string $path = "content/articles/";
    protected string $filename = "article.md";

    public function __construct(
        protected Article $article,
    ) {}


    final function defaultBody(): array
    {
        return [
            'title' => $this->article->title,
            'head' => "gumbophp:feature/{$this->article->title}",
            'base' => "master",
            'body' => $this->article->markdown,
            'draft' => false,
        ];
    }

    public function resolveEndpoint(): string
    {
        return "repos/{$this->owner}/{$this->repo}/pulls";
    }
    final function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'X-GitHub-Api-Version' => '2022-11-28',
            'Accept' => 'application/vnd.github.v3+json',
        ];
    }

}
