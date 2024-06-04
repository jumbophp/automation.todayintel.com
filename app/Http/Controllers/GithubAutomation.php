<?php
declare(strict_types=1);
namespace App\Http\Controllers;


use App\Http\Requests\ExtractArticleRequest;
use App\Saloon\Git\GitContract;
use App\Saloon\Today\TodayIntelContract;
use Illuminate\Http\JsonResponse;

class GithubAutomation extends Controller
{
    public function __invoke(
        ExtractArticleRequest $request,
        TodayIntelContract    $today,
        GitContract           $gitContract
    ):JsonResponse
    {

        $article = $today->extract($request->link);

        $createdPullRequest = $gitContract->createFile($article);

        return response()->json($createdPullRequest);
    }

}
