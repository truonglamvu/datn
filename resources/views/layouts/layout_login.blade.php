<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="{{ asset('css/style2.css') }}" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}"> <!-- Font-Awesome-Icons-CSS -->
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<!-- //css files -->
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<!-- //online-fonts -->
<style type="text/css">
    body{
        background: url({{asset('images/1.jpg')}}) no-repeat;
        background-size: cover;
    }

    .alert{
        display: block;
        padding:15px;
        color:#a94442;
        background-color: #f2dede;
        border:1px solid #ebccd1;
        margin-bottom: 15px;
        border-radius: 30px;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>
<body onload="myFunction1()">
    @yield('content')

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