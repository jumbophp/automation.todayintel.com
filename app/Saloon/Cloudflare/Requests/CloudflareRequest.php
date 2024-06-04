<?php
declare(strict_types=1);
namespace App\Saloon\Cloudflare\Requests;

use App\Data\DTO\Answer;
use App\Domain\Agents\BaseAgent;
use Illuminate\Support\Str;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Spatie\LaravelData\Data;

class CloudflareRequest extends Request implements HasBody
{

    use HasJsonBody;


    protected Method $method = Method::POST;


    public function __construct(private readonly BaseAgent $agent)
    {
    }

    final function defaultBody(): array
    {
        return [
            "messages" => [
                [
                    "role" => "system",
                    "content" => Str::limit($this->agent->getInstructions(), 6000)
                ],
                [
                    "role" => "user",
                    "content" => Str::limit($this->agent->getContext(), 6000)
                ]
            ]
        ];
    }

    final function resolveEndpoint(): string
    {
        return 'ai/run/' . $this->agent->getModel();
    }


    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): Data
    {
        $data = collect($response->json());
        return Answer::from($data->get('result'));
    }
}
