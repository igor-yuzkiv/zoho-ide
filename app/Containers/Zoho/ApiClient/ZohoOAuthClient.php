<?php

namespace App\Containers\Zoho\ApiClient;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 *
 */
final class ZohoOAuthClient
{
    /**
     *
     */
    public const BASE_URL = "https://accounts.zoho";

    /**
     * @var array
     */
    private array $dataCenter;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $dataCenterZone
     */
    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        string                  $dataCenterZone = 'us'
    )
    {
        $this->setDataCenter($dataCenterZone);
    }

    /**
     * @param array $scopes
     * @return string
     */
    public function getAuthorizationUrl(array $scopes): string
    {
        $url = self::BASE_URL . $this->getDataCenterDomain() . '/oauth/v2/auth';

        $query = [
            'scope'         => implode(",", $scopes),
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'state'         => 'code',
            'response_type' => 'code',
            'redirect_uri'  => self::getCallbackUrl(),
            'access_type'   => 'offline'
        ];
        return $url . "?" . http_build_query($query);
    }

    /**
     * @param string $code
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     */
    public function getRefreshTokenByCode(string $code): array
    {
        $url = self::BASE_URL . $this->getDataCenterDomain() . '/oauth/v2/token';

        $response = (new Client())
            ->post($url, [
                RequestOptions::QUERY => [
                    'grant_type'    => 'authorization_code',
                    'client_id'     => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'redirect_uri'  => self::getCallbackUrl(),
                    'code'          => $code,
                ],
            ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $refreshToken
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refreshAccessToken(string $refreshToken): string
    {
        $url = self::BASE_URL . $this->getDataCenterDomain() . '/oauth/v2/token';

        $response = (new Client())
            ->post($url, [
                RequestOptions::QUERY => [
                    "refresh_token" => $refreshToken,
                    "client_id"     => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type'    => 'refresh_token'
                ],
            ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response['access_token'];
    }

    /**
     * @return string
     */
    public static function getCallbackUrl(): string
    {
        return config('app.url') . "/api/project/connection/zoho-callback";
    }

    /**
     * @return string
     */
    public function getDataCenterDomain(): string
    {
        return $this->dataCenter["domain"];
    }

    /**
     * @param string $zone
     * @return void
     */
    private function setDataCenter(string $zone = 'com'): void
    {
        $dataCenter = config("zoho.auth.data_center.$zone");
        if (!$dataCenter) {
            throw new \InvalidArgumentException("$dataCenter - invalid data center");
        }

        $this->dataCenter = $dataCenter;
    }


}
