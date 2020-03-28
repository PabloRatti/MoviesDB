<?php

namespace Controllers;

use DAO\MoviesDAO as moviesDAO;

class ApiDataController
{



    function callAPI($method, $url, $data)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'APIKEY: 111111111111111111111',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }

    function getMoviesNowPlaying()
    {
        $get_data = $this->callApi('GET', 'https://api.themoviedb.org/3/movie/{movie_id}/lists?api_key=5b0b146de91894f6b7b7864538c660de&language=en-US&page=1
    ', false);
        $response = json_decode($get_data, true);
        return $response;
    }

    function getAllMovies()
    {
        $get_data = $this->callApi('GET', 'https://api.themoviedb.org/3/movie/now_playing?api_key=5b0b146de91894f6b7b7864538c660de&language=en-US&page=1', false);
        $response = json_decode($get_data, true);
        return $response;
    }
}
