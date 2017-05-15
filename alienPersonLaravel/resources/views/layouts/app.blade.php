<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="token" id="token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}">
    <link href="{{ asset('/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/small-box.css')}}" rel="stylesheet">
    <!-- <link href="{{ asset('/css/thai-sans-lite.css')}}" rel="stylesheet"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" charset="utf-8"></script>
    <script src="{{ asset('/js/sweetalert.min.js')}}" ></script>

    <!-- Scripts -->
    <!-- <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script> -->
</head>
<body>
    <div id="app">
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
                        {{ config('app.name', '') }}
                        <!-- <i class="fa fa-home fa-lg"></i> -->
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('home')? 'active' : '' }}"><a href="{{ url('/home') }}"><i class="fa fa-home fa-lg"></i></a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="{{ Request::is('login')? 'active' : '' }}"><a href="{{ route('login') }}"><i class="fa fa-sign-in fa-lg"></i> เข้าระบบ</a></li>
                            <li class="{{ Request::is('register')? 'active' : '' }}"><a href="{{ route('register') }}"><i class="fa fa-user-plus fa-lg"></i> ลงทะเบียน</a></li>
                        @else
                            @if(Auth::user()->admin === 'Y')
                                <li class="{{ Request::is('user/*') || Request::is('allUsers') ? 'active' : '' }}"><a href="{{ url('/allUsers') }}"><i class="fa fa-lock fa-lg"></i> จัดการ Users</a></li>
                            @endif
                            <li class="{{ Request::is('data/*') || Request::is('data') ? 'active' : '' }}"><a href="{{ url('/data') }}"><i class="fa fa-pencil-square-o fa-lg"></i> คีย์ข้อมูล</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-user fa-lg"></i> ( {{ Auth::user()->username }} ) <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out fa-lg"></i> ออกจากระบบ
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- <div class="container">
          <ol class="breadcrumb">
            <li><a href="{{ url('/home') }}"><i class="fa fa-home fa-lg"></i></a></li>

            <li class="active">{{Route::getFacadeRoot()->current()->uri()}}</li>
          </ol>
        </div> -->

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/bootstrap.min.js')}}" charset="utf-8"></script>
    <script src="{{ asset('/js/vue.js')}}"></script>
    <script src="{{ asset('/js/vue-resource.js')}}"></script>
    <script src="{{ asset('/js/axios.min.j')}}s"></script>
    @stack('scripts')
</body>
</html>
