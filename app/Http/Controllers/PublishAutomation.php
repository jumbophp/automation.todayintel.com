<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Domain\Agents\SocialAgent;
use App\Domain\Automation\GumboAI;
use App\Http\Requests\ExtractArticleRequest;
use App\Http\Requests\PublishArticleRequest;
use App\Saloon\Today\TodayIntelContract;
use GuzzleHttp\ClientInterface;
use Illuminate\Http\JsonResponse;

class PublishAutomation extends Controller
{
    public function __construct(private readonly ClientInterface $client)
    {}

    public function __invoke(
        PublishArticleRequest  $request,
        TodayIntelContract    $today,
        GumboAI               $ai
    ):JsonResponse
    {
        $response = $this->client->request('POST', 'https://automation.lzomedia.com/api/v1/webhooks/bFpULSiPaVCbYCIqYae3S', [
            'form_params' => $request->toArray()
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return response()->json($response);
    }

}
