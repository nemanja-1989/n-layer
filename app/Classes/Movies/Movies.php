<?php 

namespace App\Classes\Movies;

class Movies {

    public function movies() {
        require_once dirname(__DIR__) . '/../resources/views/movies.phtml';
    }
}