@extends('layouts.default')

@section('content')
    @foreach($movies->chunk(3) as $group)
        <div class="columns">
            @foreach($group as $movie)
                <div class="column">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image">
                                <img src="{{asset($movie->poster_path)}}" alt="{{$movie->title}}">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <p class="title is-5">{{$movie->title}}</p>
                                    <p class="subtitle is-6 has-text-grey">{{$movie->director}}</p>
                                </div>
                            </div>

                            <div class="content">
                                <table width="100%">
                                    <tr>
                                        <td class="has-text-left is-paddingless">
                                            <i class="fas fa-star has-text-warning is-small"></i> <span class="is-size-7 has-text-grey-light">{{$movie->rating}}</span>
                                        </td>
                                        <td class="has-text-right is-paddingless">
                                            <i class="fas fa-thumbs-up has-text-success"></i> <span class="is-size-7 has-text-grey-light">{{$movie->like_count}}</span> |
                                            <i class="fas fa-thumbs-down has-text-grey-light"></i> <span class="is-size-7 has-text-grey-light">{{$movie->unlike_count}}</span>
                                        </td>
                                    </tr>
                                </table>
                                {{str_limit($movie->description)}}<br />
                                <span class="is-size-7 has-text-grey-light"><time datetime="2016-1-1">{{$movie->publish_at->toFormattedDateString()}}</time></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@stop