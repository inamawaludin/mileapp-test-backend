<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class AppException extends Exception
{
    protected $statusCode;

    public function __construct($message, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function report()
    {
        // You can add custom logging or reporting logic here.
    }

    public function render($request)
    {
        return response()->json(['message' => $this->getMessage()], $this->statusCode);
    }
}