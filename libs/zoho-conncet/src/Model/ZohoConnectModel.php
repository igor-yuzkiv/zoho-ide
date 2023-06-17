<?php

namespace Zoho\Connect\Model;

use Illuminate\Database\Eloquent\Model;
use Zoho\Connect\ZohoOAuthClient;

/**
 *
 */
class ZohoConnectModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'zoho_connection';

    /**
     * @var string[]
     */
    protected $fillable = [
        'client_id',
        'client_secret',
        'access_token',
        'refresh_token',
        'expire',
        'domain',
        'data_center',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'expire' => 'datetime'
    ];

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken(): string
    {
        if ($this->isExpired()) {
            $this->refreshToken();
        }

        return $this->access_token;
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return (now()->diffInSeconds($this->expire, false) < 150);
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refreshToken(): void
    {
        $oauthClient = new ZohoOAuthClient($this->client_id, $this->client_secret, $this->data_center);

        $this->access_token = $oauthClient->refreshAccessToken($this->refresh_token);
        $this->expire = now()->addSeconds(3600);
        $this->save();

        $this->refresh();
    }

}
