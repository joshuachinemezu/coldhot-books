<?php

namespace App\Services;

class Curl
{
    public $error = [];
    /**
     * Make a request and fetch resources.
     *
     * @return \Illuminate\Http\Response
     */
    public static function request(array $param)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $param['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $param['method']);
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            self::$error = curl_error($ch);
            return false;
        }
        curl_close($ch);

        return json_decode($result);
    }
}
