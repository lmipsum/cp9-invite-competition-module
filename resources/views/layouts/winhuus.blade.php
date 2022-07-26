<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/winhuus.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @component('components.panel')
                    @yield('content')
                @endcomponent

                <div id="social" class="col-xs-12">
                    <a href="{{ $pageTexts['sbb_link'] }}">SBB link</a>
                    <a href="{{ $pageTexts['logo_link'] }}">Logo link</a>
                    <a href="{{ $pageTexts['shopville_link'] }}">ShopVille</a>
                    <a href="{{ $pageTexts['facebook_link'] }}">Facebook</a>
                    <a href="{{ $pageTexts['youtube_link'] }}">Youtube</a>
                    <a href="{{ $pageTexts['instagram_link'] }}">Instagram</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
