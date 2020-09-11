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
        <footer class="footer">
            Terminos y Condiciones
            Políticas Privaciad
            Soporte Técnico
            Ir a Infracounter
            Copyright 2020 Infracounter - Todos los derechos reservados
        </footer>
    </body>
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
