<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TSYPHO</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}">


        <!-- Styles -->
        <style>
            html, body {
                background: url('/alienPerson/images/background4.jpg');
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}"><i class="fa fa-home fa-2x"></i></a>
                    @else
                        <a href="{{ url('/login') }}"><i class="fa fa-sign-in fa-lg"></i> เข้าระบบ</a>
                        <a href="{{ url('/register') }}"><i class="fa fa-user-plus fa-lg"></i> ลงทะเบียน</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    TSYPHO
                </div>
                <div class="m-b-md">
                  <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="m-b-md">
                    ระบบคนต่างด้าว ( อำเภอท่าสองยาง )
                </div>

                <div class="links">
                    <a href="{{url('/home')}}">เข้าสู่เว็บไซต์</a>
                </div>
            </div>
        </div>
    </body>
</html>
