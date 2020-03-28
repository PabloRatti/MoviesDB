<?php

namespace Models;

class Movie
{
    private $id_movie;
    private $title;
    private $votes;
    private $popularity;
    private $overview;
    private $poster_path;
    private $releaseDate;
    private $genreID;

    function __construct($title, $votes, $popularity, $overview, $poster_path, $releaseDate)
    {

        $this->title = $title;
        $this->votes = $votes;
        $this->popularity = $popularity;
        $this->overview = $overview;
        $this->poster_path = $poster_path;
        $this->releaseDate = $releaseDate;
    }


    function getId()
    {
        return $this->id_movie;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getVotes()
    {
        return $this->votes;
    }

    function getPopularity()
    {
        return $this->popularity;
    }

    function getOverview()
    {
        return $this->overview;
    }

    function getPosterUrl()
    {
        return $this->poster_path;
    }

    function getReleaseDate()
    {
        return $this->releaseDate;
    }

    function getGenreID()
    {
        return $this->genresIDS;
    }

    function setId($id)
    {
        $this->id_movie = $id;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function setVotes($votes)
    {
        $this->votes = $votes;
    }

    function setPopularity($pop)
    {
        $this->popularity = $pop;
    }

    function setOverview($over)
    {
        $this->overview = $over;
    }

    function setPosterUrl($url)
    {
        $this->poster_path = $url;
    }

    function setReleaseDate($date)
    {
        $this->releaseDate = $date;
    }

    function setGenreID($genres){
        $this->genresIDS = $genres;
    }
}
