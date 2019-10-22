@extends('layouts.layout_admin')
@section('content')
	<div class="row">
        <form id="search-form" class="row">
            <div class="col-sm-12">
                <h3 align="center" style="padding-bottom: 10px;">
                    Danh sách quản lý user
                </h3>
            </div>
            <div class="col-sm-5">
                <input type="text" name="searchUser" class="form-control" id="search-user" placeholder="Enter name, email, login name..." onkeyup="searchUser()" autocomplete="off">
            </div>
            <div class="col-sm-1">
                <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
            </div>
            <div class="col-sm-5"></div>
           	<div class="col-sm-1">
                <a href="{{ route('user.create') }}" style="float:right;" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> New User</a>
           	</div>
            <input type="hidden" name="limit" value="{{!empty(Request::get('limit')) ? Request::get('limit') : '10'}}">
            <div class="col-sm-4">
           		@if(session('notification'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{{session('notification')}}</strong>
                    </div>
                @endif
            </div>
        </form>
    </div>
    <br/>
    <div class="row" id="list_docs">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="100px">Name</th>
                    <th width="300px">Address</th>
                    <th width="100px">Email</th>
                    <th>Phone</th>
                    <th>Login name</th>
                    <th colspan="4" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="user-data-{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->login_name }}</td>
                        <td><a href="{{ route('loadRole',$user->id) }}" class="btn btn-info"><i class="fa fa-list-alt" aria-hidden="true"></i> List role</a>
                        <a href="{{ route('user.edit',$user->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                        
                            <form method="POST" style="display: inline-block; margin: 0 5px">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <button data-user-id="{{ $user->id }}" type="submit" class="btn btn-danger delete_user" ><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                        
                        
                            <input type="hidden" name="id" class="user_id" value="{{ $user->id }}">
                            @if($user->status == 0)
                                <div class="pretty p-icon p-smooth" style="margin-top:3px;font-size: 20px;">
                                    <input type="checkbox" name="status" class="active-user" data-user-id="{{ $user->id }}" value="0">
                                    <div class="state">
                                        <i class="icon fa"></i>
                                        <label></label>
                                    </div>
                                </div>
                            @else
                                <div class="pretty p-icon p-smooth" style="margin-top:3px;font-size: 20px;">
                                    <input type="checkbox" name="status" class="active-user" data-user-id="{{ $user->id }}" value="1" checked>
                                    <div class="state p-success">
                                        <i class="icon fa fa-check"></i>
                                        <label></label>
                                    </div>
                                </div>
                                {{-- <input type="checkbox" name="status" class="active-user custom-checkbox" data-user-id="{{ $user->id }}" checked> --}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-md-12">
            @if(!empty($users))
                {{$users->links()}}
            @endif
        </div>
    </div>
 	<script>
	    @if(Session::has('message'))
	       var type = "{{ Session::get('alert-type','success') }}"
	       switch(type){
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                break;
            }
	    @endif
   	</script>
   	<script type="text/javascript">
   		$(document).ready(function(){
   			$(document).on('change','.active-user',function(e){
                var value1 = $(this).val();
                var obj = $(this);
                e.preventDefault();
                var user_id = $(this).attr('data-user-id');
                if(obj.is(':checked')){
                    var titleSwal = "Xác nhận";
                    var textSwal = "Bạn có muốn xác nhận tài khoản này";
                }else{
                    var titleSwal = "Hủy xác nhận";
                    var textSwal = "Bạn có muốn hủy xác nhận tài khoản này";
                }
                swal({
                    title: titleSwal,
                    text: textSwal,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Hủy",
                    showLoaderOnConfirm: true,
                    closeOnConfirm: false,
                },
                function(isConfirm){
                    
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: "active-user/"+user_id,
                            async: true,
                            data: {
                                status: value1,
                            },
                            success: function (response) {
                                if(response.value){
                                    setTimeout(function(){
                                        swal(
                                          'Thành công!',
                                          'Xác nhận tài khoản thành công!',
                                          'success'
                                        )
                                        obj.next('.state').addClass('p-success');
                                        obj.next('.state').find('.icon').addClass('fa-check');
                                        obj.prop('checked',true);
                                    },2000);
                                }else{
                                    setTimeout(function(){
                                        swal(
                                          'Hủy',
                                          'Hủy xác nhận tài khoản thành công!',
                                          'success'
                                        )
                                        obj.next('.state').removeClass('p-success');
                                        obj.next('.state').find('.icon').removeClass('fa-check');
                                        obj.prop('checked',false);
                                    },2000);
                                }
                            }
                        });
                    }
                    else{
                        if(value1 == 1){
                            obj.prop('checked',true);
                        }else{
                            obj.prop('checked',false);
                        }
                    }
                })
            });
   		})
   	</script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click','.delete_user',function(e){
                var value1 = $(this).val();
                e.preventDefault();
                var user_id = $(this).attr('data-user-id');
                swal({
                    title: "Xác nhận xóa",
                    text: "Bạn có muốn xóa tài khoản này",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Hủy",
                    showLoaderOnConfirm: true,
                    closeOnConfirm: false,
                },
                function(isConfirm){
                    setTimeout(function(){
                        if (isConfirm) {
                            $.ajax({
                                type: "DELETE",
                                url: "user/"+user_id,
                                async: true,
                                data: {
                                    id: user_id,
                                },
                                success: function (response) {
                                    if(response){
                                        swal(
                                          'Đã xóa!',
                                          'Xóa tài khoản thành công!',
                                          'success'
                                        )
                                        $('.user-data-'+user_id).remove();
                                    }
                                }
                            });
                        }
                    },2000);
                })
            });
        })
    </script>
   	<script type="text/javascript">
   		function searchUser(){
            $(document).ready(function(){
                var searchUser = $("#search-user").val();

                $.ajax({
                    type: 'GET',
                    url : '{{URL::to('admin/user-search')}}',
                    data: {'searchUser': searchUser},
                    success:function(data){
                        $('tbody').html(data);
                    }
                })

            })
        }
   	</script>
@endsection