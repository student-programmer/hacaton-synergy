<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>@yield('title-page')</title>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>
</html>