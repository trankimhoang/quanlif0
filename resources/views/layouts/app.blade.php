<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @hasSection('title')
        <title>@yield('title') - {{ env('APP_NAME', '') }}</title>
    @else
        <title>{{ env('APP_NAME', '') }}</title>
    @endif
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lib/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/popper.min.js') }}"></script>
</head>
<body>
    @yield('content')
</body>
</html>
