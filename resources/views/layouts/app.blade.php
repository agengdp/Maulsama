<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/selectize/css/selectize.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @if (Auth::user())
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                          &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Menu <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#"><strong>{{Auth::user()->name}}</strong></a>
                                    </li>
                                    <li>
                                        <a href="">Configuration</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <header class="head">
              <div class="container">

                <div class="row">
                  <div class="col-md-12">
                    <ul>
                      <li><a href="{{ route('home') }}" class="{{ isActiveRoute('home', 'active') }}">Dashboard</a></li>
                      <li><a href="{{ route('series.index') }}" class="{{ isActiveRoute('series.index', 'active') }}">Series</a></li>
                      <li><a href="{{ route('movies.index') }}" class="{{ isActiveRoute('movies.index', 'active') }}">Movies</a></li>
                      <li><a href="{{ route('genre.index') }}" class="{{ isActiveRoute('genre', 'active') }}">Genre</a></li>
                    </ul>
                  </div>
                </div>

              </div>
            </header>

            <div class="adm-title">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <h1>{{$adm_title}}</h1>
                  </div>
                </div>
              </div>
            </div>

        @endif

        <div class="container">
          @include('flash::message')
          @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bower_components/jquery.repeater/jquery.repeater.js') }}"></script>
    <script src="{{ asset('assets/selectize/js/standalone/selectize.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>

    @yield('lastfooter')

</body>
</html>
