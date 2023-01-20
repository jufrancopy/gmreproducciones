<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap 4 --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    {{-- CSS personalizado --}}
    <link rel="stylesheet" href="{{url('/static/css/connect.css?v='.time())}}">

    {{-- JQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- Font Awesome--}}
    <script src="https://kit.fontawesome.com/776ed7f2a9.js" crossorigin="anonymous"></script>
    <title> {{env('APP_NAME')}} - @yield('title')</title>
</head>
<body>
    @section('content')
    @show
</body>
</html>