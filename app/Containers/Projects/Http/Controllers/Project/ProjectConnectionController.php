<?php

namespace App\Containers\Projects\Http\Controllers\Project;

use App\Containers\Projects\Models\ProjectConnection;
use App\Containers\Projects\Services\Connection\GenerateConnectionToken;
use App\Containers\Projects\Transformers\ConnectionTransformer;
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

    public function deleteConnection(ProjectConnection $connection): JsonResponse
    {
        try {
            $status = $connection->delete();
            return  response()->json(compact('status'));
        }catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function zohoCallback(Request $request): mixed
    {
        try {
            $connection = ProjectConnection::findOrFail(Cache::get('project.connection'));

            $grandToken = $request->get('code');
            if (!$grandToken) {
                abort(500);
            }

            $action = new GenerateConnectionToken($connection, $grandToken);
            $connection = $action->run();

            return view('zoho.callback', [
                'id'      => $connection->id,
                'status'  => true,
                'message' => 'Zoho connection has been successfully established.',
            ]);
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            abort(500);
        }
    }
}
