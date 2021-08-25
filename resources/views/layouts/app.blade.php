<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm @guest navbar-light bg-white @else @if(auth()->user()->isAdmin()) navbar-dark bg-dark @else navbar-light bg-white @endif @endguest">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
                            </li>
                        @else
                            @if(auth()->user()->isUser())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('panel.posts.index') }}">{{ __('Your posts') }}</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('panel.admin.categories.index') }}">{{ __('Categories') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('panel.admin.posts.index') }}">{{ __('Posts') }}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('panel.admin.users.index') }}">{{ __('Users') }}</a>
                                </li>
                            @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
{{--            todo - use message fashing      --}}
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('no_access'))
                    <div class="alert alert-warning">
                        {{ session('no_access') }}
                    </div>
                @endif

                @if (session('no_fail'))
                    <div class="alert alert-danger">
                        {{ session('no_fail') }}
                    </div>
                @endif
            </div>

            @yield('content')
        </main>
    </div>

@yield('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script>
        console.log('here3');
        $(document).ready(function() {
            toastr.info("tessst")
        });
{{--        @if(Session::has('message'))--}}
{{--        var type="{{Session::get('alert-type','info')}}"--}}

{{--        switch(type){--}}
{{--            case 'info':--}}
{{--                toastr.info("{{ Session::get('message') }}");--}}
{{--                break;--}}
{{--            case 'success':--}}
{{--                toastr.success("{{ Session::get('message') }}");--}}
{{--                break;--}}
{{--            case 'warning':--}}
{{--                toastr.warning("{{ Session::get('message') }}");--}}
{{--                break;--}}
{{--            case 'error':--}}
{{--                toastr.error("{{ Session::get('message') }}");--}}
{{--                break;--}}
//         }
{{--        @endif--}}

    </script>
</body>
</html>
