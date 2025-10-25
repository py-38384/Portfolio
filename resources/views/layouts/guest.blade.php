<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Piyal's Portfolio</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
        <link rel="shortcut icon" href="{{ asset('assets/images/portfolio.ico') }}" type="image/x-icon">

        <link rel="stylesheet" href="{{ asset('assets/magnific_popup/magnific-popup.css') }}">
        <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <!-- Magnific Popup core JS file -->
        <script src="{{ asset('assets/magnific_popup/jquery.magnific-popup.min.js') }}"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>
        <style>
            :root {
                /* --primary-text-color: #2f435c; */
                --primary-text-color: #091729;

                @if($frontend->current_theme_color == 'blue') 
                /* preset 1 */
                --primary-body-color: #003BFC17;
                --active-text-color: #4184ff;
                --outline-default-color: #4184FF21;
                --box-shadow-color: #1831534D;
                @endif

                @if($frontend->current_theme_color == 'navy')
                /* preset 2 */
                --primary-body-color: #18315334;
                --active-text-color: #183153;
                --outline-default-color: #18315321;
                --box-shadow-color: #aec0e2;
                @endif

                @if($frontend->current_theme_color == 'green')
                /* preset 3 */
                --primary-body-color: #001AFF0C;
                --active-text-color: #00AA4D;
                --outline-default-color: #00AA4D1C;
                --box-shadow-color: #0036182D;
                @endif

                @if($frontend->current_theme_color == 'red')
                /* preset 4 */
                --primary-body-color: #FC000D17;
                --active-text-color: #FF4141;
                --outline-default-color: #FF414121;
                --box-shadow-color: #5318184D;
                @endif
                
                @if($frontend->current_theme_color == 'custom') 
                --primary-body-color: {{ $frontend->theme_colors['primary_body_color'] }};
                --active-text-color: {{ $frontend->theme_colors['active_text_color'] }};
                --outline-default-color: {{ $frontend->theme_colors['outline_default_color'] }};
                --box-shadow-color: {{ $frontend->theme_colors['box_shadow_color'] }};
                @endif


                --console-response-text-color:rgb(230 230 0);

                --console-response-anchor-text-color:rgba(0 247 255 / 0.63);

                --slider-arrow-color: gray;
                --slider-arrow-hover-color: whitesmoke;

                --primary-element-bg-color: white;

                --code-background-color: #353535;

                --code-font-color: lightgray;

                --code-copy-button-font-color: white;
                --code-copy-button-hover-font-color: darkslategray;

            }
        </style>

        @stack('styles')

        <!-- Styles / Scripts -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('sweetalert::alert')
        <div class="main-container">
            <x-custom.header />
            {{ $slot }}
            <x-custom.footer />
        </div>
        @stack('scripts')
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>
