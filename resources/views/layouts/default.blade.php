<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
    <script>

    </script>
    @yield('css')
</head>
<body>

<nav class="navbar is-expanded is-light is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{route('home')}}">
            <img src="{{asset('images/jomrun-logo.png')}}" width="112" height="28">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navMenubd-example">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navMenubd-example" class="navbar-menu">
        <div class="navbar-start">
            @if(auth()->check())
                {{link_to_route('favorite','My Favorite ' ,[],['class'=>'navbar-item ' . (request()->route()->uri == 'favorite' ? 'is-active' : '')])}}
            @endif
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                @if(auth()->check())
                    <p class="is-size-7">Welcome back {{auth()->user()->name}} <i class="fas fa-smile-wink"></i></p> &nbsp;&nbsp;
                    <div class="buttons">
                        {{link_to_route('logout','Logout',[],['class'=>'button is-white'])}}
                    </div>
                @else
                    <div class="buttons">
                        {{link_to_route('signup','Sign up',[],['class'=>'button is-primary'])}}
                        {{link_to_route('login','Log in',[],['class'=>'button is-white'])}}
                    </div>
                @endif

            </div>
        </div>
    </div>
</nav>
<br /><br />

<section class="section">
    <div class="container">
        @yield('content')
    </div>
</section>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        if ($navbarBurgers.length > 0) {
            $navbarBurgers.forEach(function ($el) {
                $el.addEventListener('click', function () {
                    var target = $el.dataset.target;
                    var $target = document.getElementById(target);

                    $el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');
                });
            });
        }
    });
</script>
@yield('js')
</body>
</html>