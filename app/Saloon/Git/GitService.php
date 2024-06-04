<?php
declare(strict_types=1);
namespace App\Saloon\Git;


use App\View\Template;
use Github\Exception\MissingArgumentException;
use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;


readonly class GitService implements GitContract
{

    private string $branch;

    private string $username;

    private string $repository;


    public function __construct(private readonly GitHubManager $gitHubManager)
    {
        $this->branch = 'master';

        $this->username = 'gumbophp';

        $this->repository = 'lzomedia.com';
    }

    /**
     * @throws MissingArgumentException
     */
    public function createIssue(Data $article): Collection
    {
        $response = $this->gitHubManager->issue()->create($this->username, $this->repository, [

            'title' => $article->title,
            'body' => $article->markdown,
            'assignees' => [
                $this->username,
            ],
            'labels' => [
                'blog'
            ],
        ]);

        return collect($response);
    }

    /**
     * @throws MissingArgumentException
     */
    public function createFile(Data $article): Collection
    {
        $slug = Str::slug($article->title);
        $path = "src/content/blog/{$slug}.md";

        $content =  (new Template())->render($article);

        $response = $this->gitHubManager->repository()->contents()->create(
            $this->username,
            $this->repository, $path,
            $content,
            "Created blog article {$article->title} for share", "blog"
        );

        return collect($response);
    }


    /**
     * @throws MissingArgumentException
     */
    public function createPullRequest(Data $article): Collection
    {
        $slug = Str::slug($article->title);
        $response = $this->gitHubManager->pullRequest()->create(
            $this->username,
            $this->repository,
            [
                'title' => "Added blog article {$article->title}",
                'body' => "Added blog article {$article->title}",
                'head' => "{$this->username}:{$this->branch}",
                'base' => $this->branch,
                'maintainer_can_modify' => true,
                'commits' => [
                    [
                        'message' => "Added blog article {$article->title}",
                        'author' => [
                            'name' => $this->username,
                            'email' => 'gumbo@lzomedia.com',
                        ],
                        'committer' => [
                            'name' => $this->username,
                            'email' => 'gumbo@lzomedia.com',
                        ],
                        'files' => [
                            [
                                'filename' => "src/content/blog/{$slug}.md",
                                'status' => 'modified',
                                'additions' => 1,
                                'deletions' => 0,
                                'changes' => 1,
                            ],
                        ],
                    ]
                ],
                'labels' => [
                    'blog'
                ],
            ]);

        return collect($response);
    }

}
