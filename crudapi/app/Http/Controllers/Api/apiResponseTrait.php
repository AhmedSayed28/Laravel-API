<?php

namespace App\Http\Controllers\Api;

trait apiResponseTrait
{
    public function apiSuccess($data, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function apiError($errors, $message = null, $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'status code' => $code
        ]);
    }
}
