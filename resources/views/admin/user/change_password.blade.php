@extends('layouts.layout_admin')

@section('content')
	<div class="row">
        <div class="col-sm-9">
           <h3>Đổi mật khẩu</h3>
        </div>
        <div class="col-sm-9">
            <form action="{{ route('changePassword',Auth::id()) }}" method="POST" role="form">
           	    {{ csrf_field() }}
           	    {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="">Mật khẩu cũ</label>
                    <input type="password" class="form-control" name="password" placeholder="..." required>
                </div>

                <div class="form-group">
                    <label for="">Mật khẩu mới</label>
                    <input type="password" class="form-control" name="password_new" placeholder="..." required>
                </div>

                <div class="form-group">
                    <label for="">Xác nhận mật khẩu mới</label>
                    <input type="password" class="form-control" name="password_new" placeholder="..." required>
                </div>

                <button type="submit" class="btn btn-primary" style="float:right;">Xác nhận</button>
            </form>
        </div>
    </div>
@endsection