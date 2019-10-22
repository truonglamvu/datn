
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
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>
<body>
<!-- main -->
<div class="center-container">
	<!--header-->
	<div class="header-w3l">
		<h1>Đăng nhập vào trang chủ</h1>
	</div>
	<!--//header-->
	<div class="main-content-agile wow slideInDown">
		<div class="sub-main-w3">	
			<div class="wthree-pro">
				<h2>Đăng nhập</h2>
			</div>
			<form action="{{ route('guestLogin') }}" method="post">
				{{ csrf_field() }}
				<div class="pom-agile{{ $errors->has('email') ? ' has-error' : '' }}">
					@if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
					<input placeholder="E-mail"  name="email" class="user" type="email" required="">
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<div class="pom-agile{{ $errors->has('password') ? ' has-error' : '' }}">
					@if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
					<input  placeholder="Password" name="password" class="pass" type="password" required="">
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				</div>
			</form>
		</div>
	</div>
	<!--//main-->
</div>
</body>
</html>