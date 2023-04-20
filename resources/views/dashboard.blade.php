<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thi trắc nghiệm online</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/v3.0.0/line.css') }}">
    @yield('head')
</head>

<body class="layout-light side-menu">
    <div class="mobile-search">
        <form action="https://demo.dashboardmarket.com/" class="search-form">
            <img src="img/svg/search.svg" alt="search" class="svg">
            <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="Search..."
                aria-label="Search">
        </form>
    </div>
    <div class="mobile-author-actions"></div>
    @include('layouts.components.header')
    <main class="main-content">
        @if (session('status'))
            <div class="alert alert-{{ session('type') }}" id="{{ session('type') }}">
                {{ session('status') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById({{ session('type') }}).style.display = "none";
                }, 5000); // 5000 milliseconds = 5 seconds
            </script>
        @endif
        @include('layouts.components.sidebar')
        @yield('content');
        @include('layouts.components.footer')

    </main>
    @include('layouts.components.loader')
    <div class="overlay-dark-sidebar"></div>
    <div class="customizer-overlay"></div>
    @include('layouts.components.customize')

    <script src="{{ asset('assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.min.js') }}"></script>
    @yield('js')
</body>

</html>

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
