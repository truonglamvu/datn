@extends('layouts.layout_login')
@section('content')
<!-- main -->
<div class="center-container">
    <!--header-->
    <div class="header-w3l">
        <h1>Please login to access</h1>
    </div>
    <!--//header-->
    <div class="main-content-agile wow slideInDown">
        <div class="sub-main-w3">   
            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                @if ($errors->has('email'))
                    <div class="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
                <div class="pom-agile{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input placeholder="{{ __('Your email') }}"  name="email" value="{{ old('email') }}" class="user" type="email" required="">
                    <span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                </div>
                <div class="pom-agile{{ $errors->has('password') ? ' has-error' : '' }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <input  placeholder="{{ __('Your password') }}" name="password" class="pass" type="password" required="">
                    <span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
                </div>
                <div class="sub-w3l">
                    <div class="row">
                        <div class="col-sm-6" style="color: white;text-align: right;">
                            Bạn chưa có tài khoản? <a href="{{route('register')}}" style="color: blue;">Đăng ký ngay</a>
                        </div>
                        <br>
                        <div class="col-sm-6" style="text-align: right;">
                            <a href="{{ route('password.request') }}" style="color: blue;text-align: right;">{{ __('Quên mật khẩu?') }}</a>
                        </div>
                    </div>
                    
                    
                    <div class="right-w3l">
                        <input type="submit" value="{{ __('Login') }}" />
                    </div>
                </div>
                    
            </form>
        </div>
    </div>
    <!--//main-->
</div>
@endsection