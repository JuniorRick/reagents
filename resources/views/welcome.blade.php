<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CRDM</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
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
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        {{-- <a href="{{ route('register') }}">Register</a> --}}
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md crdm">
                  Centrul Republican de Diagnosticare Medicala
                </div>

                {{-- <div class="links">
                    <a href="/reagents">Reagenti</a>
                    <a href="/orders">Eliberare noua</a>
                    <a href="/orders/all">Eliberari totale</a>
                    <a href="/people">Persoane</a>
                    <a href="/producers">Producatori</a>

                </div> --}}
            </div>
        </div>
        <script type="text/javascript">

        window.addEventListener('load', changeHeader);
          window.addEventListener('resize', changeHeader);

          function changeHeader() {
            if(window.innerWidth < 620) {
              document.querySelector('.crdm').innerText = 'CRDM';
            } else {
              document.querySelector('.crdm').innerText = 'Centrul Republican de Diagnosticare Medicala';
            }
          }
        </script>
    </body>
</html>
