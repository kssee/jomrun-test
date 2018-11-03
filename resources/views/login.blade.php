@extends('layouts.default')

@section('css')
    <style>
        .box {
            margin-top: 5rem;
        }

        .avatar {
            margin-top: -70px;
            padding-bottom: 20px;
        }

        .avatar img {
            padding: 5px;
            background: #fff;
            border-radius: 50%;
            -webkit-box-shadow: 0 2px 3px rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .1);
            box-shadow: 0 2px 3px rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .1);
        }

        input {
            font-weight: 300;
        }

        p {
            font-weight: 700;
        }

        p.subtitle {
            padding-top: 1rem;
        }
    </style>
@stop

@section('content')
    <section class="hero">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <p class="subtitle has-text-grey">Login to view your favorite movies.</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="{{asset('images/jomrun-icon.png')}}">
                        </figure>
                        {{Form::open()}}
                        @include('layouts.error-list')
                        <div class="field">
                            <div class="control">
                                {{Form::email('email','',['placeholder'=>'Your Email','class'=>'input is-large','autofocus','required'])}}
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                {{Form::password('password',['placeholder'=>'Your Password','class'=>'input is-large'])}}
                            </div>
                        </div>
                        <button class="button is-block is-info is-large is-fullwidth">Login</button>
                        {{Form::close()}}
                    </div>
                    <p>{!! link_to_route('signup','Sign Up') !!}</p>
                </div>
            </div>
        </div>
    </section>
@stop