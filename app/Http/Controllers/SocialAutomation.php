<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Domain\Agents\SocialAgent;
use App\Domain\Automation\GumboAI;
use App\Http\Requests\ExtractArticleRequest;
use App\Saloon\Today\TodayIntelContract;
use Illuminate\Http\JsonResponse;

class SocialAutomation extends Controller
{
    public function __invoke(
        ExtractArticleRequest $request,
        TodayIntelContract    $today,
        GumboAI               $ai
    ):JsonResponse
    {
        $response = $today->extract($request->link);

        $blogAgent = new SocialAgent();

        $blogAgent->setContext($response->text);

        $answer = $ai->getAnswer($blogAgent);

        return response()->json([
            'answer' => $answer,
            'article' => $response,
        ]);
    }

}
