<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@if(session('message'))
    <script>
        $(document).ready(function () {
            $("#alert").fadeTo(2000, 500).slideUp(500, function () {
                $("#alert").slideUp(500);
            });
        });
    </script>
    <div class="alert alert-success" role="alert" id="alert">
        {{session('message')}}
    </div>
@endif
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <a class="container">
            <a class="navbar-brand" href="{{route('home')}}">{{__('interface.Home')}}</a>
            @auth
                <a class="navbar-brand" href="{{ url('/edit ') }}">
                    {{ __('Create Ad')}}
                </a>
            @endauth
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#FormModal" href="#"
                               onclick="event.preventDefault()">{{ __('Login') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </a>
    </nav>
</div>


<main class="py-4">
    @yield('content')
</main>
</div>
@guest
    @if ($errors->any())
        <script>
            $(document).ready(function () {
                $('#FormModal').modal('show')
            });
        </script>
    @endif
    <div class="modal fade" id="FormModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            @include('auth.login')
        </div>
    </div>

@endguest
</body>
</html>
