<?php
namespace App\src\Response\Infrastructure\Adapters;

use App\src\Response\Domain\Contracts\ICustomResponse;

class LaravelCustomResponse implements ICustomResponse
{
    public function responseTo($success, $message, $data, $respondeCode)
    {       
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $respondeCode);
    }
}