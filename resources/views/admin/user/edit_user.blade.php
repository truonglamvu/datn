@extends('layouts.layout_admin')
@section('content')
    <div class="row">
        <div class="col-sm-9">
           <h3>Cập nhật User</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li><font color="red">(*)</font>{{ $error }}</li>
                        @endforeach
                        
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-sm-9">
            <form action="{{ route('user.update',$user->id) }}" class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label for="" class="col-sm-2 control-label">Date of birth</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" name="date_of_birth" value="{{ $user->date_of_birth }}" data-provide="datepicker">
                        @if ($errors->has('date_of_birth'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('date_of_birth') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                        @if ($errors->has('address'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label for="" class="col-sm-2 control-label">Gender </label>
                    <div class="col-sm-4"> 
                        @if($user->gender == 1)
                        <input type="radio" name="gender" value="{{ $user->gender }}" checked> Nam
                        <input type="radio" name="gender" value="{{ $user->gender }}"> Nữ
                        @endif
                        @if($user->gender == 0)
                        <input type="radio" name="gender" value="{{ $user->gender }}"> Nam
                        <input type="radio" name="gender" value="{{ $user->gender }}" checked> Nữ
                        @endif
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
                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                        @if ($errors->has('phone'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label for="" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        @if ($errors->has('email'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Login name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="login_name" value="{{ $user->login_name }}">
                        @if ($errors->has('login_name'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('login_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label for="" class="col-sm-2 control-label">Avarta</label>
                    <div class="col-sm-4">
                        <span><input type="file" id="avarta_name" name="avarta" onchange="readURL(this);" value="{{ $user->avarta }}"><span></span></span>
                        <div style="margin-top: 10px;">
                            <img src="{{ asset('uploads/'.$user->avarta) }}" id="img_upload" style="height:100px;max-width: 200px;" >
                        </div>
                        @if ($errors->has('avarta'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('avarta') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="status" value="1">
                </div>

                <button type="submit" class="btn btn-primary" style="float:right;">Cập nhật</button>
            </form>
            <a href="{{ route('userBackPage') }}" class="btn btn-success" style="margin-top:70px;width: 120px; "><i class="fa fa-reply" aria-hidden="true"></i></a>
        </div>
    </div>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection