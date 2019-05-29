<?php

if (!function_exists('JSON')) {
    function JSON($status_code, $data, String $message='')
    {
        $status = $status_code == 200 || $status_code == 201 || $status_code == 204 ? 'success' : 'failed';

        if ($message == '') {
            $response = [
                'status_code' => $status_code,
                'status' => $status,
                'data' => $data,
            ];
        } else {
            $response = [
                'status_code' => $status_code,
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ];
        }

        return response()->json(
            $response,
            $status_code
        );
    }
}

const CODE_SUCCESS = 200;
const CODE_CREATE_SUCCESS = 201;
const CODE_REMOVE_SUCCESS = 200;
const CODE_REDIRECT = 302;
const CODE_BAD_REQUEST = 400;
const CODE_UNAUTHORIZED = 401;
const CODE_PAYMENT_NEEDED = 402;
const CODE_FORBIDDEN = 403;
const CODE_NOT_FOUND = 404;
const CODE_VALIDATION_ERROR = 422;
const CODE_SERVER_ERROR = 500;
