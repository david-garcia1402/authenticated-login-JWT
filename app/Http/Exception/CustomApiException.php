<?php

namespace App\Http\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomApiException extends HttpException {

    public function __construct(int $code, string $message) 
    {
        $this->code = $code;
        $this->message = $message;
    }

    public function ApiResponse()
    {
        return abort(
            $this->code,
            $this->message
        );
    }
}