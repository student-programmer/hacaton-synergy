<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <title>@yield('title-page')</title>
</head>
<body>
    <div class="alert alert-primary position-fixed top-0 end-0 d-none" role="alert" id="alert-auth"></div>
    <div class="container">
        <div class="d-flex justify-content-center">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>
</html>