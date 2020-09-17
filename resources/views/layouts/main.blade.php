<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IA Calendar - @yield('title')</title>

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div id="app">

            {{-- Content --}}
            @yield('content')

        </div>
        <footer class="footer py-2 px-6 @yield('class-footer')">
            <div class="columns has-text-centered">
                <div class="column columns my-0">
                    <div class="column"><a href="#">Terminos y Condiciones</a></div>
                    <div class="column"><a href="#">Políticas Privaciad</a></div>
                    <div class="column"><a href="#">Soporte Técnico</a></div>
                    <div class="column"><a href="#">Ir a Infracounter</a></div>
                </div>
                <div class="column is-two-fifths">
                    <div class="column">
                        Copyright 2020 Infracounter - Todos los derechos reservados
                    </div>
                </div>
            </div>
        </footer>
    </body>
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
