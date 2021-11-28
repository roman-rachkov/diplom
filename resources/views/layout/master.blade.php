<!--END-->
<!--END--><!DOCTYPE html><!--[if IE 7]>
<html class="ie7" lang="ru">
<![endif]-->
<!--[if IE 8]>
<html class="ie8" lang="ru">
<![endif]-->
<!--[if IE 9]>
<html class="ie9" lang="ru">
<![endif]-->
<!--[if IE 10]>
<html class="ie10" lang="ru">
<![endif]-->
<!--[if IE 11]>
<html class="ie11" lang="ru">
<![endif]-->
<!--[if gt IE 11]><!--> <html lang="ru"> <!--<![endif]-->
<head>
    <title>@yield('title', 'Товарный агрегатор Megano')</title>
    <meta name="description" content="Товарный агрегатор Megano ">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/favicon.ico') }}" rel="shortcut icon">
    <link rel="preload" href="{{asset('fonts/Roboto-Regular.woff')}}" as="font">
    <link rel="preload" href="{{asset('fonts/Roboto-Italic.woff')}}" as="font">
    <link rel="preload" href="{{asset('fonts/Roboto-Bold.woff')}}" as="font">
    <link rel="preload" href="{{asset('fonts/Roboto-Bold_Italic.woff')}}" as="font">
    <link rel="preload" href="{{asset('fonts/Roboto-Light.woff')}}" as="font">
    <link rel="preload" href="{{asset('fonts/Roboto-Light_Italic.woff')}}" as="font">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="Site">
<!--if lt IE 8
p.error-browser
    | Ваш браузер&nbsp;
    em устарел!&nbsp;
    a(href="http://browsehappy.com/") Выберите новую версию
        +s
        | браузера здесь&nbsp;
    | для правильного отображения сайта.
-->
@include('layout.header')

<div class="Middle Middle_top">
    @includeUnless(request()->routeIs('banners'), 'layout.breadcrumbs')

    @yield('content')
</div>

@include('layout.footer')

<!--+Middle-->
<!--    +div.-top-->
<!--        +breadcrumbs('Главная','Портфолио')-->
<!--    +Article('portfolio')-->
<!---->

<script>
    window.echoConfig = {
        host: {!! json_encode(env('APP_URL')) !!},
        port: {!! json_encode(env('LARAVEL_ECHO_SERVER_PORT')) !!}
    };
</script>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/plg/CountDown/countdown.js')}}"></script>
<!--[if lt IE 9]><script src="{{asset('http://html5shiv.googlecode.com/svn/trunk/html5.js')}}"></script><![endif]-->

@stack('scripts')

</body></html>
