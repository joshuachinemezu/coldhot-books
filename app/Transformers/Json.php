<?php

if (!function_exists('JSON')) {
    function JSON($status_code, array $data, String $message = null, $status =true)
    {
        $status = $status_code == 200 ? true : false;

        return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ], $status_code);
    }
}

const CODE_SUCCESS = 200;
const CODE_REDIRECT = 302;
const CODE_BAD_REQUEST = 400;
const CODE_UNAUTHORIZED = 401;
const CODE_PAYMENT_NEEDED = 402;
const CODE_FORBIDDEN = 403;
const CODE_NOT_FOUND = 404;
const CODE_VALIDATION_ERROR = 422;
const CODE_SERVER_ERROR = 500;
