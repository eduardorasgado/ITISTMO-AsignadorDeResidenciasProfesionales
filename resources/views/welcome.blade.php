<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Electrica - ITISTMO</title>

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

            #buttonStart, #button1, #button2 {
                color: white;
                background: orange;
                padding: 10px;
                border: none;
                border-radius: 5px;
                transition: all 0.3s ease 0s;
            }
            #buttonStart:hover, #button1:hover, #button2:hover {
                background: white;
                color: gray;

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
                font-size: 5vw;
            }
            .subtitle {
                font-size: 2vw;
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

            .footty {
                width: 50vw;
                margin: auto;
            }

            @media (max-width: 700px){
                .portada {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" >
                            <button id="buttonStart">Comencemos Aquí</button>
                        </a>
                    @else
                        <a href="{{ route('login') }}"><button id="button1">Entrar</button></a>
                        <a href="{{ route('register') }}"><button id="button2">Registro</button></a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Academia de Eléctrica del Instituto Tecnológico De Istmo
                </div>
                <div class="subtitle">
                    Asignador de Sinodalías de Residencias Profesionales
                </div>
                <br>
                 <img class="portada" src="{{asset('images/portada.png')}}" alt="Portada" height="100">
            </div>
        </div>
        <footer class="footty">
                <p>Desarrollado por: <a href="https://lalodigitaliza.me">Eduardo Rasgado</a></p>
        </footer>
    </body>
</html>
