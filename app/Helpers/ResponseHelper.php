<?php 

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function jsonResponse($succes, $message, $data, $statusCOde): JsonResponse
    {
        return response()->json([
            'success' => $succes,
            'message' => $message,
            'data' => $data,
        ], $statusCOde);
    }
}