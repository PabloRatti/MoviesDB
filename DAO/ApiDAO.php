<?php 
namespace DAO;
use Models\Movie;

class ApiDAO {


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
   
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            API_KEY,
            Content_type,
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
   
   
    function getListAPI($movieID)
    {
        $get_data = $this->callApi('GET', "https://api.themoviedb.org/3/movie/" . $movieID . "/lists?api_key=5b0b146de91894f6b7b7864538c660de&language=en-US&page=1", false);
        $response = json_decode($get_data, true);
        return $response;
    }

    function getMoviesNowPlayingAPI()
    {
        $get_data = $this->callApi('GET', 'https://api.themoviedb.org/3/movie/now_playing?api_key=5b0b146de91894f6b7b7864538c660de&language=en-US&page=1', false);
        $response = json_decode($get_data, true);
        return $response;
    }

    function getGenres()
    {
        $get_data = $this->callApi('GET', 'https://api.themoviedb.org/3/genre/movie/list?api_key=5b0b146de91894f6b7b7864538c660de&language=en-US', false);
        $response = json_decode($get_data, true);
        return $response;
    }

   

   
    function getMoviesNowPlaying()
    {
        $db = new moviesPDO();
        $data = $db->getAll();
        return $data;
    } 

    function deleteTableContent($table)
    {
        try {
            $query = "DELETE FROM " . $table;
            $this->connection = Connection::GetInstance();
            $this->connection->Execute($query);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }

    function updateMoviesDB()
    {
        
        //$this->deleteTableContent("Movies");

        $apiMovies = $this->getMoviesNowPlayingAPI();
        $movies = $apiMovies["results"];

        foreach ($movies as $mov) {
            $newMovie = new Movie($mov["title"], $mov["vote_count"], $mov["popularity"], $mov["overview"], $mov["poster_path"], $mov["release_date"]);
            $newMovie->setGenreID($mov["genre_ids"][0]);
           // $this->Add($newMovie);
        }
    }


}




?>