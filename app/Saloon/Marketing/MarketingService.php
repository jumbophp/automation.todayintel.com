<?php
declare(strict_types=1);
namespace App\Saloon\Marketing;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use PharIo\Manifest\Email;

readonly class MarketingService implements MarketingContract
{

    public function __construct(private ClientInterface $client)
    {
        //
    }

    /**
     * @throws GuzzleException
     */
    public function send(Email $email)
    {
        $this->client->post('https://api.mautic.org/api/v1/messages', [
            'form_params' => [
                'api_key' => env('MAUTIC_API_KEY'),
                'email' => $email->subject,
                'message' => $email->message,
            ],
        ]);
    }
}
