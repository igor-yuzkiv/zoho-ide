<?php

namespace App\Containers\Projects\Services\Connection;

use App\Containers\Projects\Enums\ConnectionStatus;
use App\Containers\Projects\Models\ProjectConnection;
use App\Containers\Zoho\ApiClient\ZohoOAuthClient;
use App\Ship\Contracts\Runnable;

/**
 *
 */
class GenerateConnectionToken implements Runnable
{
    /**
     * @var ZohoOAuthClient
     */
    private ZohoOAuthClient $oAuthClient;

    /**
     * @param ProjectConnection $connection
     * @param string $grandToken
     */
    public function __construct(
        protected ProjectConnection $connection,
        protected string            $grandToken
    )
    {
        $this->oAuthClient = new ZohoOAuthClient(
            clientId: $this->connection->client_id,
            clientSecret: $this->connection->client_secret,
            dataCenterZone: $this->connection->data_center,
        );
    }

    /**
     * @return ProjectConnection
     */
    public function run(): ProjectConnection
    {
        $response = $this->getRefreshToken();

        $this->connection->update([
            'access_token'  => $response['access_token'],
            'refresh_token' => $response['refresh_token'],
            'domain'        => $this->oAuthClient->getDataCenterDomain(),
            'expire'        => now()->addSeconds(\Arr::get($response, 'expires_in', 3600)),
            'status'        => ConnectionStatus::ACTIVE->value,
        ]);

        return $this->connection;
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getRefreshToken(): array
    {
        $response = $this->oAuthClient->getRefreshTokenByCode($this->grandToken);

        if (
            !array_key_exists('access_token', $response)
            || !array_key_exists('refresh_token', $response)
        ) {
            throw new \RuntimeException('Invalid response from Zoho');
        }

        return $response;
    }
}
