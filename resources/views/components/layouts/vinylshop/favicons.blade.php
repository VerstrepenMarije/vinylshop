<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    {{-- resources/views/components/favicons.blade.php --}}

    <link rel="icon" type="image/png" href="/assets/icons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/icons/favicon.svg" />
    <link rel="shortcut icon" href="/assets/icons/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/icons/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/icons/site.webmanifest" />


    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
{{ $slot }}

@livewireScripts
</body>
</html>
