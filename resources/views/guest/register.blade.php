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
    <style type="text/css">
        body{
            background: url({{asset('images/1.jpg')}}) no-repeat;
            background-size: cover;
        }
    </style>
    <script src="{{ asset('js/jquery-2.1.4.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.pwdMeter.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>
</head>
<body onload="myFunction2()">
    <div id="app" class="bg-image">
        <div class="container">
        <h1 style="color: white;text-align: center;">Đăng kí thành viên</h1>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default" style="width: 780px;margin-left: 0;">
                        <div class="panel-heading">Form đăng ký thành viên</div>
                        
                        <div id="floatingBarsG">
                            <div class="blockG" id="rotateG_01"></div>
                            <div class="blockG" id="rotateG_02"></div>
                            <div class="blockG" id="rotateG_03"></div>
                            <div class="blockG" id="rotateG_04"></div>
                            <div class="blockG" id="rotateG_05"></div>
                            <div class="blockG" id="rotateG_06"></div>
                            <div class="blockG" id="rotateG_07"></div>
                            <div class="blockG" id="rotateG_08"></div>
                        </div>

                        <div class="panel-body wow slideInDown" style="display:none" id="form-regis">
                            <form class="form-horizontal" method="POST" action="{{ route('guestRegister') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Họ và tên</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus placeholder="Please enter your name....">

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                                    <label for="date_of_birth" class="col-md-4 control-label">Ngày sinh</label>

                                    <div class="col-md-6">
                                        <input id="date_of_birth" type="text" class="form-control datepicker" name="date_of_birth" data-date-format="dd/mm/yyyy" name="date_of_birth" placeholder="dd-mm-YYYY" data-provide="datepicker" value="{{ old('date_of_birth') }}">

                                        @if ($errors->has('date_of_birth'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date_of_birth') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-4 control-label">Địa chỉ</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Please enter your address....">

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label for="gender" class="col-md-4 control-label">Giới tính</label>

                                    <div class="col-md-6">
                                        <input id="gender" type="radio" name="gender" value="1"> Nam
                                        <input id="gender" type="radio" name="gender" value="0"> Nữ

                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" class="col-md-4 control-label">Số điện thoại</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="+84 123 456 789">

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Please enter your email....">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('login_name') ? ' has-error' : '' }}">
                                    <label for="login_name" class="col-md-4 control-label">Tên đăng nhập</label>

                                    <div class="col-md-6">
                                        <input id="login_name" type="text" class="form-control" name="login_name" value="{{ old('login_name') }}" placeholder="Please enter your login name....">

                                        @if ($errors->has('login_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('login_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('avarta') ? ' has-error' : '' }}">
                                    <label for="avarta" class="col-md-4 control-label">Ảnh đại diện</label>

                                    <div class="col-md-6">
                                        <input id="avarta_name" type="file" name="avarta" value="{{ old('avarta') }}" onchange="readURL(this);">

                                        <div style="margin-top: 10px;">
                                            <img id="img_upload" style="height:100px;max-width: 200px;display: none;" >
                                        </div>

                                        @if ($errors->has('avarta'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('avarta') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                                    <div class="col-md-6">
                                        <input id="pswd" type="password" class="form-control" name="password" placeholder="Please enter your password....">
                                        <span id="pwdMeter" class="neutral"></span>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Xác nhận mật khẩu</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Please enter your confirm password....">
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="0">
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                           <i class="fa fa-pencil" aria-hidden="true"></i> Đăng ký
                                        </button>
                                        <a href="{{ route('gLogin') }}" class="btn btn-danger" style="width: 79px;"><i class="fa fa-ban" aria-hidden="true"></i> Hủy</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_upload').css('display','block');
                    $('#img_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#pwdMeter').hide();
            $("#pswd").on('keyup',function(){
                $('#pwdMeter').show();
                $("#pswd").pwdMeter();
            });
        })
    </script>
    <script type="text/javascript">
        var loader;

        function myFunction2(){
            loader = setTimeout(showPage2, 2000);
        }

        function showPage2(){
            document.getElementById('floatingBarsG').style.display = "none";
            document.getElementById('form-regis').style.display = "block";
        }
    </script>
</body>
</html>
