<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ URL::to('/') }}/pp/favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{ URL::to('/') }}/pp/favicon.ico" type="image/x-icon">

    <title>Swa3ed - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href=" {{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('vendor/css/adminCSS.css')}}" rel="stylesheet">
    @yield('styles')


</head>

<body>
    @include('admin/includes.adminHeader')
    <div class="">
        @yield('content')
    </div>
    @include('admin/includes.footer')
