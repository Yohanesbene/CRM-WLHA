<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
</head>

<body>
    @yield('content')
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>