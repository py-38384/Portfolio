<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />

        <link rel="stylesheet" href="{{ asset('assets/magnific_popup/magnific-popup.css') }}">
        <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <!-- Magnific Popup core JS file -->
        <script src="{{ asset('assets/magnific_popup/jquery.magnific-popup.min.js') }}"></script>


        <!-- Styles / Scripts -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="main-container">
            <x-custom.header />
            {{ $slot }}
            <x-custom.footer />
        </div>
        <script src="/assets/js/typed.js"></script>
        <script>
            var typed = new Typed('#element', {
            strings: ['Pial Hossen'],
            typeSpeed: 150,
            });
        </script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>
