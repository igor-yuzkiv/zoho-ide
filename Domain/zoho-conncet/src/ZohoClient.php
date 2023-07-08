<?php

namespace Domain\Zoho\Connect;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Domain\Zoho\Connect\Model\ZohoConnectModel;

/**
 *
 */
class ZohoClient extends Client
{
    /**
     * @var ZohoConnectModel
     */
    protected ZohoConnectModel $connectModel;

    /**
     * @param array $config
     * @param string|null $clientId
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct(array $config = [], ?string $clientId = null)
    {
        if (!$clientId) {
            $clientId = config('zoho.connection.client_id');
        }
        $this->connectModel = ZohoConnectModel::where('client_id', $clientId)->firstOrFail();

        $config[RequestOptions::HEADERS]['Authorization'] = 'Zoho-oauthtoken ' . $this->connectModel->getAccessToken();

        /*Replace top level domain*/
        if (isset($config['base_uri'])) {
            $host = parse_url($config['base_uri'], PHP_URL_HOST);
            $tld = substr($host, strrpos($host, '.'));
            $config['base_uri'] = str_replace($tld, $this->connectModel->domain, $config['base_uri']);
        }

        parent::__construct($config);
    }


    /**
     * @return ZohoConnectModel
     */
    public function getConnectModel(): ZohoConnectModel
    {
        return $this->connectModel;
    }
}
