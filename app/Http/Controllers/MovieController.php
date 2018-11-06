<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MovieController extends ApiController
{
    public function movieList(Request $request)
    {
        $this->requestLog(json_encode($request->all()), 'movie-list', $request->getClientIp());

        $validator = Validator::make($request->all(), [
            'search' => 'string|nullable|max:100',
        ]);

        if ($validator->fails()) {
            $error_msg = $this->formatValidatorMessage($validator);
            return $this->respondValidationFailed($error_msg);
        }

        if ($request->has('search')) {
            $data = Movie::where('title', 'like', '%' . $request->search . '%')->orWhere('director', 'like', '%' . $request->search . '%')->orderBy('publish_at', 'desc')->get();
        } else {
            $data = Movie::orderBy('publish_at', 'desc')->get();
        }

        $result = [];
        foreach ($data as $item) {
            $result[] = [
                'id' => $item->id,
                'title' => $item->title,
                'director' => $item->director,
                'poster' => asset($item->poster_path),
                'publish_at' => $item->publish_at,
                'rating' => $item->rating,
                'comment_count' => $item->comment_count,
                'like_count' => $item->like_count,
                'unlike_count' => $item->unlike_count,
            ];
        }

        return $this->respondSuccess(['data' => $result]);
    }

    public function favoriteList(Request $request)
    {
        $this->requestLog(json_encode($request->all()), 'favorite-list', $request->getClientIp());

        $validator = Validator::make($request->all(), [
            'username' => 'required|email',
        ]);

        if ($validator->fails()) {
            $error_msg = $this->formatValidatorMessage($validator);
            return $this->respondValidationFailed($error_msg);
        }

        $user = User::where('email',$request->username)->first();
        if (empty($user)) {
            return $this->respondNotFound('Member not found');
        }

        $data = Movie::orderBy('publish_at', 'desc')
            ->leftJoin('user_favorite_movies', 'movie_id', 'movies.id')
            ->select('movies.*')
            ->where('user_favorite_movies.user_id', $user->id)
            ->get();

        $result = [];
        foreach ($data as $item) {
            $result[] = [
                'id' => $item->id,
                'title' => $item->title,
                'director' => $item->director,
                'poster' => asset($item->poster_path),
                'publish_at' => $item->publish_at,
                'rating' => $item->rating,
                'comment_count' => $item->comment_count,
                'like_count' => $item->like_count,
                'unlike_count' => $item->unlike_count,
            ];
        }

        return $this->respondSuccess(['data' => $result]);
    }
}
