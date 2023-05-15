<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MyNewMoviesController extends Controller
{
    public function indexM(Request $request)
    {
        if ($request->has('movie')) {
            $response = Http::get('https://api.themoviedb.org/3/movie/' . $request->input('movie'), [
                'api_key' => env('TMDB_API_KEY'),
            ]);

            $movie = $response->json();
        } else {
            $movie = null;
        }

        $response = Http::get('https://api.themoviedb.org/3/movie/popular', [
            'api_key' => env('TMDB_API_KEY'),
        ]);

        $movies = $response->json()['results'];

        return view('movies.index', compact('movie', 'movies'));
    }

    public function indexS(Request $request)
    {
        if ($request->has('series')) {
            $response = Http::get('https://api.themoviedb.org/3/tv/' . $request->input('series'), [
                'api_key' => env('TMDB_API_KEY'),
            ]);

            $serie = $response->json();
        } else {
            $serie = null;
        }

        $response = Http::get('https://api.themoviedb.org/3/tv/popular', [
            'api_key' => env('TMDB_API_KEY'),
        ]);

        $series = $response->json()['results'];

        return view('tvshows.index', compact('serie', 'series'));
    }
}
