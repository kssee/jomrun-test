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

<section class="section">
    <div class="container">
        <nav class="navbar is-expanded" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
                    <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navMenubd-example">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navMenubd-example" class="navbar-menu">
                <div class="navbar-start">
                    {{link_to_route('home','Movies',[],['class'=>'navbar-item ' . (request()->route()->uri == '/' ? 'is-active' : '')])}}
                    @if(auth()->check())
                    {{link_to_route('favorite','Favorite ' ,[],['class'=>'navbar-item ' . (request()->route()->uri == 'favorite' ? 'is-active' : '')])}}
                    @endif

                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        @if(auth()->check())
                            <div class="buttons">
                                {{link_to_route('logout','Logout',[],['class'=>'button is-light'])}}
                            </div>
                        @else
                            <div class="buttons">
                                {{link_to_route('signup','Sign up',[],['class'=>'button is-primary'])}}
                                {{link_to_route('login','Log in',[],['class'=>'button is-light'])}}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </nav>

        @include('layouts.error-list')

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