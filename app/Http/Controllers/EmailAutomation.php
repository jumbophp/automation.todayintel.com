<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Data\DTO\Article;
use App\Domain\Agents\EmailAgent;
use App\Domain\Agents\SocialAgent;
use App\Domain\Automation\GumboAI;
use App\Http\Requests\ExtractArticleRequest;
use App\Http\Requests\GenerateUserEmail;
use App\Saloon\Today\TodayIntelContract;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class EmailAutomation
 */
class EmailAutomation extends Controller
{
    public function __invoke(
        GenerateUserEmail $request,
        TodayIntelContract    $today,
        GumboAI               $ai,
    ):JsonResponse
    {

        $blogAgent = new EmailAgent();

        //todo create class content
        $context = new Article();

        $context->text = $request->information;

        $blogAgent->setContext($context->text);

        $answer = $ai->getAnswer($blogAgent);

        return response()->json($answer);
    }

}
