<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 *
 */
final class ResponseUtil
{
    /**
     *
     */
    public const EXCEPTION_WHITE_LIST = [
        \DomainException::class,
        ValidationException::class
    ];

    /**
     *
     */
    const DEFAULT_ERROR = "Something went wrong, try again later.";

    /**
     * @param string|null $message
     * @param array $data
     * @param int $code
     * @param int $status
     * @return JsonResponse
     */
    public static function error(?string $message = null, array $data = [], int $code = -1, int $status = 400): JsonResponse
    {
        return response()->json([
            "message" => $message ?? self::DEFAULT_ERROR,
            'data'    => $data,
            'code'    => $code,
        ], $status);
    }

    /**
     * @param \Exception $exception
     * @param array $data
     * @return JsonResponse
     */
    public static function exception(\Exception $exception, array $data = []): JsonResponse
    {
        if ($exception instanceof ValidationException) {
            return self::validationException($exception);
        }

        $message = self::DEFAULT_ERROR;
        $status = 500;
        if (in_array(get_class($exception), self::EXCEPTION_WHITE_LIST)) {
            $message = $exception->getMessage();
            $status = 400;
        }

        return self::error(
            message: $message,
            data: $data,
            status: $status
        );
    }

    /**
     * @param ValidationException $exception
     * @return JsonResponse
     */
    public static function validationException(ValidationException $exception): JsonResponse
    {
        return self::error(
            $exception->getMessage(),
            $exception->errors() ?? [],
            $exception->getCode()
        );
    }
}
