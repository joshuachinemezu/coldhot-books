<?php

namespace App\Http\Controllers;

use App\Services\Curl;

class ExternalBookController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        // Check if name is passed
        if (!$name) {
            return JSON(CODE_BAD_REQUEST, []);
        }

        // Make request to ice-fire endpoint and fetch books
        // Guzzle can also be used for making this request.
        try {
            $param = [
                    "url" => config('app.ice_fire_url').'?name='. urlencode($name),
                    "method" => 'GET',
                ];
            $response = Curl::request($param);
        } catch (\Exception $ch) {
            return JSON(CODE_BAD_REQUEST, ['error' => $ch]);
        }

        $data = [];
        foreach ($response as $res) {
            $authors = [];
            foreach ($res->authors as $author) {
                array_push($authors, $author);
            }
            $datum = [
                "name" => $res->name,
                "isbn" => $res->isbn,
                "authors" => $authors,
                "number_of_pages" => $res->numberOfPages,
                "publisher" => $res->publisher,
                "country" => $res->country,
                "release_date" => date('Y-m-d', strtotime($res->released)),
            ];
            array_push($data, $datum);
        }
        


        return JSON(CODE_SUCCESS, $data);
    }
}
