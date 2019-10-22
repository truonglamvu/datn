@extends('layouts.layout_admin')

@section('content')
	<div class="row">
        <div class="col-sm-9">
            <h3>Thêm mới Permission</h3> 
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
            <form action="{{ route('permission.store') }}" method="POST" role="form">
           	    {{ csrf_field() }}
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Please enter role name ..." value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block alert alert-danger">
                            <strong><font color="red">(*)</font> {{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
				
                <div class="form-group">
                    <label for="">Display name</label>
                 	<input type="text" class="form-control" name="display_name" placeholder="Please enter display name ..." value="{{ old('display_name') }}">
                    @if ($errors->has('display_name'))
                        <span class="help-block alert alert-danger">
                            <strong><font color="red">(*)</font> {{ $errors->first('display_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Please enter description ..." value="{{ old('description') }}">
                    @if ($errors->has('description'))
                        <span class="help-block alert alert-danger">
                            <strong><font color="red">(*)</font> {{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
              
                <button type="submit" class="btn btn-primary" style="float:right;">Thêm mới</button>
            </form>
            <a href="{{ route('permissionBackPage') }}" class="btn btn-success" style="width: 120px;"><i class="fa fa-reply" aria-hidden="true"></i></a>
        </div>
    </div>
@endsection