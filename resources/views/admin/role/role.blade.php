@extends('layouts.layout_admin')

@section('content')
	<div class="row">
    	<div class="col-sm-12">
	       <h3 align="center" style="padding-bottom: 10px;">Danh sách quản lý Role</h3>
	       <a href="{{ route('role.create') }}" class="btn btn-primary" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
       	</div>
       	<div class="col-sm-8"></div>
       	<div class="col-sm-4">
        	@if(session('notification'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{session('notification')}}</strong>
                </div>
            @endif
       	</div>
    </div>
    <br />
    <div class="row">
       <table class="table table-hover table-bordered">
	        <thead>
	            <tr>
	                <th>#</th>
	                <th width="100px">Name</th>
	                <th>Display name</th>
	                <th>Description</th>
	                <th colspan="3" style="text-align: center;">Action</th>
	            </tr>
	        </thead>
          	<tbody>
		      	@if(isset($roles))
		          	@foreach($roles as $role)
			            <tr class="role-data-{{ $role->id }}">
			                <td>{{ $role->id }}</td>
			                <td>{{ $role->name }}</td>
			                <td>{{ $role->display_name }}</td>
			                <td>{{ $role->description }}</td>
			                <td>
			                	<a href="{{ route('rolePermission',$role->id) }}" class="btn btn-info"><i class="fa fa-list-alt" aria-hidden="true"></i> List Permission</a>
			                	<a href="{{ route('role.edit',$role->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
		                		<form method="POST" style="display: inline-block; margin: 0 5px">
				               		{{ csrf_field() }}
				               		{{ method_field('DELETE')}}
				               		<button data-role-id="{{ $role->id }}" type="submit" class="btn btn-danger delete_role"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
			               		</form>
		               		</td>
			            </tr>
			        @endforeach
			    @endif
          	</tbody>
       	</table>
    </div>
   	<div class="col-md-12">
    	@if(!empty($roles))
        	{{$roles->links()}}
    	@endif
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
            $(document).on('click','.delete_role',function (e) {
                var value = $(this).val();
                e.preventDefault();
                var id = $(this).attr('data-role-id');
                swal({
                    title: "Xác nhận xóa",
                    text: "Bạn có muốn xóa vai trò này",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Đồng ý!",
                    cancelButtonText: "Hủy",
                    showLoaderOnConfirm: true,
                    closeOnConfirm: false
                },
                function(isConfirm){
                	setTimeout(function(){
	                    if (isConfirm) {
	                        $.ajax({
	                            type: "DELETE",
	                            url: "role/"+id,
	                            async: true,
	                            data: {
	                                id: id,
	                            },
	                            success: function (response) {
	                                if(response){
	                                    swal(
	                                      'Đã xóa!',
	                                      'Bạn đã xóa vai trò thành công',
	                                      'success'
	                                    )
	                                    $('.role-data-'+id).remove();
	                                }
	                            }
	                        });
	                    }
	                },2000);
                })
            }); 
        })
    </script>
@endsection