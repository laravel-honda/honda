<!doctype html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | {{ config('app.name') }}</title>
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }} | {{ config('app.name') }}"/>
    @isset ($description)
        <meta name="description" content="{{ $description }}">
        <meta property="og:description" content="{{ $description }}">
    @endisset
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:locale" content="{{ App::getLocale() }}"/>
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    @livewireStyles
    <x-assets-style href="css/app.css"/>
    <x-assets-script src="js/app.js"/>
    <x-assets-render/>
</head>
<body {{ $attributes->class('bg-gray-100 font-medium') }}>
{{ $slot }}
@livewireScripts
</body>
</html>
