<?php

namespace Domain\Zoho\Connect\Http\Controllers;

use App\Containers\ZohoAuth\ZohoOAuthClient;
use Domain\Zoho\Connect\Http\Requests\AuthorizationRequest;
use Domain\Zoho\Connect\Http\Requests\CallbackRequest;
use Domain\Zoho\Connect\Model\ZohoConnectModel;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

/**
 *
 */
class ZohoConnectController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * @return mixed
     */
    public function index(): mixed
    {
        try {
            Cache::forget("zoho.auth.credentials.id");
            Cache::forget("zoho.auth.credentials.secret");

            $scopes = file_get_contents(__DIR__ . '/../../../scopes.json');

            return view("zoho.auth.index", [
                'callback_url'        => ZohoOAuthClient::getCallbackUrl(),
                'data_center'         => config("zoho.auth.data_center"),
                'default_data_center' => config("zoho.auth.default_data_center"),
                'scopes'              => json_decode($scopes, true)
            ]);
        } catch (\Exception $e) {
            return view("zoho.auth.error");
        }
    }

    /**
     * @param AuthorizationRequest $request
     * @return mixed
     */
    public function authorization(AuthorizationRequest $request): mixed
    {
        try {
            $clientId = $request->get('id');
            $clientSecret = $request->get('secret');

            Cache::add("zoho.auth.credentials.id", $clientId, now()->addHour());
            Cache::add("zoho.auth.credentials.secret", $clientSecret, now()->addHour());

            $oAuthClient = new ZohoOAuthClient($clientId, $clientSecret, $request->get('data_center'));
            $url = $oAuthClient->getAuthorizationUrl($request->get('scopes'));

            return redirect($url);
        } catch (\Exception $e) {
            return view("zoho.auth.error");
        }
    }

    /**
     * @param CallbackRequest $request
     * @return mixed
     */
    public function callback(CallbackRequest $request): mixed
    {
        try {
            $clientId = Cache::get("zoho.auth.credentials.id");
            $clientSecret = Cache::get("zoho.auth.credentials.secret");

            $oAuthClient = new ZohoOAuthClient(
                clientId: $clientId,
                clientSecret: $clientSecret,
                dataCenterZone: $request->get("location"),
            );

            $response = $oAuthClient->getRefreshTokenByCode($request->get('code'));

            if (!array_key_exists('access_token', $response) || !array_key_exists('refresh_token', $response)) {
                return view("zoho.auth.error");
            }

            ZohoConnectModel::updateOrCreate(
                ['client_id' => $clientId],
                [
                    'client_id'     => $clientId,
                    'client_secret' => $clientSecret,
                    'data_center'   => $request->get("location"),
                    'domain'        => $oAuthClient->getDataCenterDomain(),
                    'access_token'  => $response['access_token'],
                    'refresh_token' => $response['refresh_token'],
                    'expire'        => now()->addSeconds(\Arr::get($response, 'expires_in', 3600)),
                ]
            );

            Cache::forget("zoho.auth.credentials.id");
            Cache::forget("zoho.auth.credentials.secret");

            return view("zoho.auth.success");
        } catch (GuzzleException $e) {
            return view("zoho.auth.error");
        }
    }
}
