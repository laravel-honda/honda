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
    @if ($description)
        <meta name="description" content="{{ $description }}">
        <meta property="og:description" content="{{ $description }}">
    @endif
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:locale" content="{{ App::getLocale() }}"/>
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <livewire:styles/>
    <x-assets-style href="css/app.css"/>
    <x-assets-resources type="style"/>
    <x-assets-resources type="raw-style"/>
</head>
<body {{ $attributes->merge(['class' => "bg-gray-100 font-medium"])}}>
{{ $slot }}

@livewireScripts
<x-assets-script href="js/app.js"/>
<x-assets-resources type="script"/>
<x-assets-resources type="raw-script"/>
</body>
</html>
