@extends('layouts.layout_admin')
@section('content')
	<div class="row">
        <div class="col-sm-9">
            <h3>Thêm mới User</h3>
        </div>
        <div class="col-sm-9">
            <form action="{{ route('user.store') }}" class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
           	    {{ csrf_field() }}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="name" placeholder="Please enter your name..." value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label for="" class="col-sm-2 control-label">Date of birth</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="date_of_birth" placeholder="dd-mm-YYYY" data-provide="datepicker" value="{{ old('date_of_birth') }}">
                        @if ($errors->has('date_of_birth'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('date_of_birth') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <br />    
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="address" placeholder="Please enter your address..." value="{{ old('address') }}">
                        @if ($errors->has('address'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label for="" class="col-sm-2 control-label">Gender </label>
                    <div class="col-sm-4">
                        <input type="radio" name="gender" value="1"> Nam
                        <input type="radio" name="gender" value="0"> Nữ
                        @if ($errors->has('gender'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="phone" placeholder="+84 123 456 789" value="{{ old('phone') }}">
                        @if ($errors->has('phone'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label for="" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" name="email" placeholder="Please enter your email..." value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
                        <span><input type="password" class="form-control" id="pswd" name="password" placeholder="Please enter your password (0-9, a-z, A-Z,!@#$%^&*,...)" value="{{ old('password') }}"></span><span id="pwdMeter" class="neutral"></span>
                        @if ($errors->has('password'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label for="" class="col-sm-2 control-label">Login name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="login_name" placeholder="Please enter your login name..." value="{{ old('login_name') }}">
                        @if ($errors->has('login_name'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('login_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
				
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Avarta</label>
                    <div class="col-sm-4">
                        <input type="file" name="avarta" id="avarta[]" multiple onchange="document.getElementById('image-user').src = window.URL.createObjectURL(this.files[0])">
                        <div style="margin-top: 10px;">
                            <img id="image-user" src="{{ !empty(old('avarta')) ? asset('uploads/'.old('avarta')) : asset('uploads/default_image.png') }}" style="height:100px;max-width: 200px;" >
                        </div>
                        @if ($errors->has('avarta'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('avarta') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="status" value="0">
                </div>

                <button type="submit" class="btn btn-primary" style="float:right;">Thêm mới</button>
            </form>
            <a href="{{ route('userBackPage') }}" class="btn btn-success" style="margin-top:70px;width: 120px; "><i class="fa fa-reply" aria-hidden="true"></i></a>
        </div>
    </div>
@endsection