<?php

namespace App\Containers\Projects\Http\Controllers\Project;

use App\Containers\Projects\Models\ProjectConnection;
use App\Containers\Projects\Transformers\ConnectionTransformer;
use App\Containers\ZohoAuth\ZohoOAuthClient;
use App\Http\Requests\ProjectConnectionRequest;
use App\Ship\Http\Controllers\Controller;
use App\Ship\Utils\LoggerUtil;
use App\Ship\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use League\Fractal\Serializer\ArraySerializer;

/**
 *
 */
class ProjectConnectionController extends Controller
{
    /**
     * @param ProjectConnection $connection
     * @param Request $request
     * @return JsonResponse
     */
    public function getConnection(ProjectConnection $connection, Request $request): JsonResponse
    {
        try {
            $includes = [];
            if ($request->has('includes')) {
                $includes = explode(',', $request->get('includes'));
            }

            return fractal($connection)
                ->transformWith(new ConnectionTransformer())
                ->serializeWith(ArraySerializer::class)
                ->parseIncludes($includes)
                ->respond();
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    /**
     * @param ProjectConnectionRequest $request
     * @return JsonResponse
     */
    public function createConnection(ProjectConnectionRequest $request): JsonResponse
    {
        try {
            $connection = ProjectConnection::create($request->validated());
            return fractal($connection)
                ->transformWith(new ConnectionTransformer())
                ->serializeWith(ArraySerializer::class)
                ->respond();
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    /**
     * @param ProjectConnection $connection
     * @param ProjectConnectionRequest $request
     * @return JsonResponse
     */
    public function updateConnection(ProjectConnection $connection, ProjectConnectionRequest $request): JsonResponse
    {
        try {
            dd($request->toArray());
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    /**
     * @param ProjectConnection $connection
     * @return JsonResponse|void
     */
    public function getAuthorizationUrl(ProjectConnection $connection)
    {
        try {
            Cache::add("project.connection", $connection->id, now()->addHour());

            $oAuthClient = new ZohoOAuthClient(
                clientId: $connection->client_id,
                clientSecret: $connection->client_secret,
                dataCenterZone: $connection->data_center,
            );

            return response()->json([
                'url' => $oAuthClient->getAuthorizationUrl($connection->scopes),
            ]);
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    public function zohoCallback(Request $request)
    {
        try {
            $connection = ProjectConnection::findOrFail(Cache::get('project.connection'));

            $oAuthClient = new ZohoOAuthClient(
                clientId: $connection->client_id,
                clientSecret: $connection->client_secret,
                dataCenterZone: $connection->data_center,
            );

            $response = $oAuthClient->getRefreshTokenByCode($request->get('code'));

            if (
                !array_key_exists('access_token', $response)
                || !array_key_exists('refresh_token', $response)
            ) {
                throw new \RuntimeException('Invalid response from Zoho');
            }

            $connection->update([
                'access_token'  => $response['access_token'],
                'refresh_token' => $response['refresh_token'],
                'domain'        => $oAuthClient->getDataCenterDomain(),
                'expire'        => now()->addSeconds(\Arr::get($response, 'expires_in', 3600)),
            ]);

            return view('zoho.callback', [
                'id' => $connection->id,
                'status'        => true,
                'message'       => 'Zoho connection has been successfully established.',
            ]);
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            abort(404);
        }
    }
}
