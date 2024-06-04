<?php
declare(strict_types=1);
namespace App\Saloon\Cloudflare;

use App\Data\DTO\Answer;
use App\Domain\Agents\BaseAgent;
use App\Domain\Automation\GumboAI;
use App\Saloon\Cloudflare\Connector\CloudflareConnector;
use App\Saloon\Cloudflare\Requests\CloudflareRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

readonly class CloudflareAIService implements GumboAI
{

    public function __construct(private CloudflareConnector $cloudflare)
    {

    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getAnswer(BaseAgent $agent): Answer
    {
        $request = New CloudflareRequest($agent);
        $response = $this->cloudflare->send($request);
        return $response->dtoOrFail();
    }
}
