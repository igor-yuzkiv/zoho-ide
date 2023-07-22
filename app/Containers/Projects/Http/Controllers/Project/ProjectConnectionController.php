<?php

namespace App\Containers\Projects\Http\Controllers\Project;

use App\Containers\Projects\Models\ProjectConnection;
use App\Http\Requests\ProjectConnectionRequest;
use App\Ship\Http\Controllers\Controller;
use App\Ship\Utils\LoggerUtil;
use App\Ship\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class ProjectConnectionController extends Controller
{
    /**
     * @param ProjectConnectionRequest $request
     * @return JsonResponse
     */
    public function createConnection(ProjectConnectionRequest $request): JsonResponse
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
    public function authorizeConnection(ProjectConnection $connection)
    {
        try {
            dd($connection->toArray());
        } catch (\Exception $exception) {
            LoggerUtil::exception($exception);
            return ResponseUtil::exception($exception);
        }
    }
}
