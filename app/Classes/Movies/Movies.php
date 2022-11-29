<?php 

namespace App\Classes\Movies;

class Movies {

    /**
     * @return void
     * @throws \Exception
     */
    public function movies() {
        require_once dirname(__DIR__) . '/../resources/views/movies.phtml'
        ?? throw new \Exception("Movies does not exists!");
    }
}