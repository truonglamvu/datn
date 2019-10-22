<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administrator Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
//<![CDATA[
window.__mirage2 = {petok:"38ac1be26a59678e16201396c70d81c4ab6953b6-1517381526-1800"};
//]]>
</script>
<script type="text/javascript" src="https://ajax.cloudflare.com/cdn-cgi/scripts/04b3eb47/cloudflare-static/mirage2.min.js"></script>
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>
<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('images/bg-01.jpg') }}');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <span class="login100-form-title p-b-49">
                    Reset Password
                </span>
                <form class="login100-form validate-form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                        <span class="label-input100">Email Address</span>
                        <input id="email" type="email" class="input100" name="email" value="{{ $email or old('email') }}" required autofocus>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input id="password" type="password" class="input100" name="password" required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Password is required">
                        <span class="label-input100">Confirm Password</span>
                        <input id="password-confirm" type="password" class="input100" name="password_confirmation" required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <script src="{{ asset('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23581568-13');
    </script>
</body>
</html>



