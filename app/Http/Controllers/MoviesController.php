<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmd.token'))
            ->get('https://api.themoviedb.org/3/movie/popular?api_key=a74e927f9068d357b6818110771b250b&language=en-US&page=1')
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmd.token'))
            ->get('https://api.themoviedb.org/3/movie/now_playing?api_key=a74e927f9068d357b6818110771b250b&language=en-US&page=1')
            ->json()['results'];

        $genres = Http::withToken(config('services.tmd.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=a74e927f9068d357b6818110771b250b&language=en-US&page=1')
            ->json()['genres'];

        //dump($popularMovies);
        //dump($nowPlayingMovies);

        /*return view('index', [
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'genres' => $genres,
        ]);*/

        $viewModel = new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres
        );

        return view('index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmd.token'))
            ->get('https://api.themoviedb.org/3/movie/' .$id. '?api_key=a74e927f9068d357b6818110771b250b&append_to_response=credits,videos,images')
            ->json();

        //dump($movie);

        $viewModel = new MovieViewModel($movie);

        return view('show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
