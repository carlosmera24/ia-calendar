<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('img/site.webmanifest') }}">

        <title>IA Calendar's - @yield('title')</title>

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
                    <div class="column"><a href="#">@lang('footer.terms')</a></div>
                    <div class="column"><a href="#">@lang('footer.policies')</a></div>
                    <div class="column"><a href="#">@lang('footer.support')</a></div>
                    <div class="column"><a href="#">@lang('footer.go_infracounter')</a></div>
                </div>
                <div class="column is-two-fifths">
                    <div class="column">
                        @lang('footer.copyright')
                    </div>
                </div>
            </div>
        </footer>
    </body>
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
