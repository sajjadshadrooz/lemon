<?php

namespace App\Traits;

Trait ApiResponser
{

    protected function successResponser($data, $code, $message=null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function successWithoutDataResponser($code, $message=null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], $code);
    }

    protected function errorResponser($code, $message=null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }

}

