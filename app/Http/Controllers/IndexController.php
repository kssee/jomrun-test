<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home()
    {
        $movies = Movie::orderBy('publish_at', 'desc')->get();

        return view('home', compact('movies'));
    }
    public function favorite()
    {
        $movies = Movie::orderBy('publish_at', 'desc')->get();

        return view('home', compact('movies'));
    }
}
