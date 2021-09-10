<head>
    <meta charset="utf-8">

    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth <meta name="isAuth" content="true"> @endauth

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700,800,900|Material+Icons" rel="stylesheet">

    <meta name="theme-color" content="#DB4716">

    <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}">
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>



</head>
