<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mytour Docs API</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <script src="{{ asset('js/jquery-2.1.4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.pwdMeter.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        new WOW().init();
    </script>
</head>
<body onload="myFunction1()">
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script>
    var myVar1;

    function myFunction1() {
        myVar1 = setTimeout(showPage1, 2000);
    }

    function showPage1() {
      document.getElementById("floatingBarsG").style.display = "none";
      document.getElementById("form-register").style.display = "block";
    }
</script>
</body>
</html>
