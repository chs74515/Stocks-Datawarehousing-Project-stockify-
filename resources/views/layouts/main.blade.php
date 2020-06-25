<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Stockify') }}</title>

    <!-- MD Compiled -->
    <link href="{{ asset('css/mdcompiled.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/fontawesome-all.min.css') }}">

    <!-- custom styles (optional) -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iThing-min.css') }}" rel="stylesheet">
    <link href="{{asset('jquery-ui/css/smoothness/jquery-ui-1.8.10.custom.css')}}" rel="stylesheet">
    
    <!-- c3 for charts -->
    <link href="{{ asset('css/c3.min.css') }}" rel="stylesheet">

</head>

<body>

<!-- header -->
@include('layouts.header')
<!-- header -->

@yield('content')

<!-- page-footer -->
@include('layouts.footer')
<!-- page-footer -->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<!-- modernizr -->
<script type="text/javascript" src="{{ asset('js/modernizr.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

{{-- circle animation --}}
<script type="text/javascript" src="{{ asset('js/circle-progress.js')}}"></script>
<script type="text/javascript" src="{{ asset('jquery-ui/js/jquery-ui-1.8.16.custom.min.js')}}"></script>

{{-- date range slider  --}}
<script type="text/javascript" src="{{ asset('js/jQAllRangeSliders-min.js')}}"></script>

{{-- charts lib --}}
<script type="text/javascript" src="{{ asset('js/d3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/c3.min.js') }}"></script>


<script type="text/javascript" src="{{ asset('js/main.js')}}"></script>


<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();
</script>

{{-- dynamic section to render javascript --}}
@yield("content-js")

</body>

</html>