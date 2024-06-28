<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait APIResponsesTrait
{
    /**
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function successResponse(mixed $data, string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function errorResponse(string $message, int $status): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $status);
    }
}