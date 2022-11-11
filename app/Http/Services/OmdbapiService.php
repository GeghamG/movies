<?php

namespace App\Http\Services;

use App\Models\Movie;
use App\Models\Poster;
use Illuminate\Support\Facades\Http;

class OmdbapiService {

    protected $base_url;
    protected $api_key;
    protected $request_urls;

    public function __construct() {
        $config = config('omdbapi');
        $this->api_key = $config['api_key'];
        $this->base_url = $config['base_url'];
        $this->request_urls = $config['request_urls'];
    }

    public function getRequestUrls() {
        return $this->request_urls;
    }

    public function fetchAndInsertMovies($request_url_key) {
        $page = 1;
        $data = [];
        while (true) {
            $response = Http::get($this->base_url . '?' . ($this->request_urls[$request_url_key] ?? '') . '&apikey=' . $this->api_key . '&page=' . $page)->json();
            if ($response['Response'] !== 'True') {
                break;
            }
            $page++;
            $data = array_merge($data, $response['Search']);
        }

        $this->saveMovies($data);
        return true;
    }

    public function saveMovies(array $movies) {
        foreach($movies as $movie) {
            if (Movie::where('imdb_id', $movie["imdbID"])->exists()) {
                continue;
            }

            $dbMovie = Movie::create([
                'title' => $movie["Title"],
                'year' => $movie["Year"],
                'imdb_id' => $movie["imdbID"],
                'type' => $movie["Type"],
            ]);

            if (isset($movie['Poster'])) {
                $dbMovie->poster()->create([
                    'url' => $movie['Poster']
                ]);
            }
        }
    }
}
