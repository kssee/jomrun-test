<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\UserFavoriteMovie;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function home()
    {
        $movies = Movie::orderBy('publish_at', 'desc')->get();
        if (auth()->check()) {
            $favorite_list = UserFavoriteMovie::where('user_id', auth()->user()->id)->pluck('movie_id', 'movie_id');
        }

        return view('home', compact('movies', 'favorite_list'));
    }

    public function favorite()
    {
        if (!auth()->check()) {
            return redirect()->route('home')->withErrors('You need login to add this movie to your favorite list.');
        }

        $movies = Movie::orderBy('publish_at', 'desc')
            ->leftJoin('user_favorite_movies', 'movie_id', 'movies.id')
            ->select('movies.*')
            ->where('user_favorite_movies.user_id', auth()->user()->id)
            ->get();

        return view('favorite', compact('movies'));
    }

    public function addFavorite($id)
    {
        if (!auth()->check()) {
            return redirect()->route('home')->withErrors('You need login to add this movie to your favorite list.');
        }

        $checkExist = UserFavoriteMovie::where('movie_id', $id)->where('user_id', auth()->user()->id)->first();
        if ($checkExist) {
            return redirect()->route('home')->withErrors('This movie was already in your favorite list.');
        }

        $favorite = new UserFavoriteMovie();
        $favorite->user_id = auth()->user()->id;
        $favorite->movie_id = $id;
        $favorite->save();

        return redirect()->route('home');
    }


    public function removeFavorite($id)
    {
        if (!auth()->check()) {
            return redirect()->route('home')->withErrors('You need login to remove this movie to your favorite list.');
        }

        $back = Input::get('back');

        $favorite = UserFavoriteMovie::where('movie_id', $id)->where('user_id', auth()->user()->id)->first();
        if (!$favorite) {
            return redirect()->route('home')->withErrors('Favorite movie not found.');
        }

        $favorite->delete();

        return redirect()->route($back == 'fav' ? 'favorite' : 'home');
    }
}
