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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div id="map" class="bg-dark" style="height:500px">
        </div>
        <script>
window.onload=function initMap(){
    console.log('egutisan');
    // googleMapsAPIを持ってくるときに,callback=initMapと記述しているため、initMap関数を作成
    // welcome.blade.phpで描画領域を設定するときに、id=mapとしたため、その領域を取得し、mapに格納します。
    map = document.getElementById("map");
    // 東京タワーの緯度は35.6585769,経度は139.7454506と事前に調べておいた
    let tokyoTower = {lat: 35.6585769, lng: 139.7454506};
    // オプションを設定
    opt = {
        zoom: 13, //地図の縮尺を指定
        center: tokyoTower, //センターを東京タワーに指定
    };
    // 地図のインスタンスを作成します。第一引数にはマップを描画する領域、第二引数にはオプションを指定
    mapObj = new google.maps.Map(map, opt);

};
        </script>
        {{-- <script src="{{ asset('js/result.js') }}" defer></script> --}}
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyC43r8ZkHSn_2lphwvdzlGx3qdc6QKf--w&callback=initMap" async defer>
        </script>

    </div>
</body>
</html>
