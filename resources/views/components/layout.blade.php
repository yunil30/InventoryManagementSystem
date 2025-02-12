<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Inventory System</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.css')
</head>
<body>
    @include('components.header')

    <main>
        {{ $slot }}
    </main>

    @include('components.footer')
</body>
</html>

