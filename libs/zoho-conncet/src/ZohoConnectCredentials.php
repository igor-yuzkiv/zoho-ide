<?php

namespace Zoho\Connect;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

/**
 *
 */
class ZohoConnectCredentials implements Arrayable
{
    /**
     * @var string
     */
    private string $client_id;

    /**
     * @var string
     */
    private string $client_secret;

    /**
     * @var string
     */
    private string $data_center = 'us';

    /**
     * @var string
     */
    protected string $access_token;

    /**
     * @var string
     */
    protected string $refresh_token;

    /**
     * @var \DateTime|Carbon
     */
    protected \DateTime|Carbon $expire;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'access_token'  => $this->access_token,
            'refresh_token' => $this->refresh_token,
            'data_center'   => $this->data_center,
            'expire'        => $this->expire,
        ];
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    public function setClientId(string $client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     */
    public function setClientSecret(string $client_secret): void
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @return string
     */
    public function getDataCenter(): string
    {
        return $this->data_center;
    }

    /**
     * @param string $data_center
     */
    public function setDataCenter(string $data_center): void
    {
        $this->data_center = $data_center;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    /**
     * @param string $refresh_token
     */
    public function setRefreshToken(string $refresh_token): void
    {
        $this->refresh_token = $refresh_token;
    }

    /**
     * @return \DateTime|Carbon
     */
    public function getExpire(): \DateTime|Carbon
    {
        return $this->expire;
    }

    /**
     * @param \DateTime|Carbon $expire
     * @return void
     */
    public function setExpire(\DateTime|Carbon $expire): void
    {
        $this->expire = $expire;
    }
}
