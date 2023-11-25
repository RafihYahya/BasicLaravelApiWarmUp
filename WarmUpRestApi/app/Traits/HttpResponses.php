<?php

namespace App\Traits;

trait HttpResponses
{
    protected function Ok($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Request Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }
    protected function Err($data, $message = null, $code)
    {
        return response()->json([
            'status' => 'Request Failed',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}