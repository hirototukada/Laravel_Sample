<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '家計簿') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/map.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/map.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div id="map">
        </div>
        {{-- <script src="{{ asset('js/result.js') }}" defer></script> --}}
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyC43r8ZkHSn_2lphwvdzlGx3qdc6QKf--w&callback=initMap"
                async defer>
        </script>

    </div>
</body>

</html>
