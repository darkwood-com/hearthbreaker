<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HSReplay
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \JsonException
     */
    public function getCollection($region, $account, $sessionId): array
    {
        $response = $this->client->request('GET', "https://hsreplay.net/api/v1/collection/?region=$region&account_lo=$account", [
            'headers' => ['cookie' => "sessionid=$sessionId"]
        ]);

        return json_decode($response->getContent(), true);
    }

    public function getCards(): array
    {
        $response = $this->client->request('GET', 'https://api.hearthstonejson.com/v1/latest/frFR/cards.json');

        $cards = json_decode($response->getContent(), true);

        $cardsByIds = [];
        foreach ($cards as $card) {
            $cardsByIds[$card['dbfId']] = $card;
        }

        return $cardsByIds;
    }
}