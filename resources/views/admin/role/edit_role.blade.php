@extends('layouts.layout_admin')

@section('content')
	<div class="row">
        <div class="col-sm-9">
           <h3>Cập nhật Role</h3>
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
            <form action="{{ route('role.update',$role->id) }}" method="POST" role="form">
           	    {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                    @if ($errors->has('name'))
                        <span class="help-block alert alert-danger">
                            <strong><font color="red">(*)</font> {{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
				
                <div class="form-group">
                 	<label for="">Display name</label>
                 	<input type="text" class="form-control" name="display_name" value="{{ $role->display_name }}">
                    @if ($errors->has('display_name'))
                        <span class="help-block alert alert-danger">
                            <strong><font color="red">(*)</font> {{ $errors->first('display_name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ $role->description }}">
                    @if ($errors->has('description'))
                        <span class="help-block alert alert-danger">
                            <strong><font color="red">(*)</font> {{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary" style="float:right;">Cập nhật</button>
            </form>
            <a href="{{ route('roleBackPage') }}" class="btn btn-success" style="width: 120px; "><i class="fa fa-reply" aria-hidden="true"></i></a>
        </div>
    </div>
@endsection