<?php

namespace App\Http\Controllers;

use App\Http\Requests\FetchMovies;
use App\Http\Resources\MovieResource;
use App\Http\Services\OmdbapiService;
use App\Models\Movie;

class MovieController extends Controller
{
    public function __construct(OmdbapiService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = MovieResource::collection(Movie::with('poster')->get());
        return response()->json($movies);
    }
    
    public function fetchMovies(FetchMovies $request) {
        return response()->json([
            'success' => $this->service->fetchAndInsertMovies($request->button_key)
        ]);
    }
}
