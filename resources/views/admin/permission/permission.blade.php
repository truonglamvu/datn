@extends('layouts.layout_admin')

@section('content')
	<div class="row">
    	<div class="col-sm-12">
	       <h3 align="center" style="padding-bottom: 10px;">Danh sách quản lý Permission</h3>
	    </div>
	       <a href="{{ route('permission.create') }}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
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
	                <th colspan="2" style="text-align: center;">Action</th>
             	</tr>
          	</thead>
	        <tbody>
	          	@if(isset($permissions))
		          	@foreach($permissions as $permission)
			            <tr class="permission-data-{{ $permission->id }}">
			            	<td>{{ $permission->id }}</td>
			            	<td>{{ $permission->name }}</td>
			                <td>{{ $permission->display_name }}</td>
			                <td>{{ $permission->description }}</td>
			                <td>
			                	<a href="{{ route('permission.edit',$permission->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></a>
			                	<form method="POST" style="display: inline-block; margin: 0 5px">
				               		{{ csrf_field() }}
				               		{{ method_field('DELETE')}}
				               		<button data-permission-id="{{ $permission->id }}" type="submit" class="btn btn-danger delete_permission"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
				               </form>
		               		</td>
			            </tr>
			        @endforeach
			    @endif
	        </tbody>
	    </table>
	</div>
    <div class="col-md-12">
        @if(!empty($permissions))
            {{$permissions->links()}}
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
            $(document).on('click','.delete_permission',function (e) {
                var value = $(this).val();
                e.preventDefault();
                var id = $(this).attr('data-permission-id');
                swal({
                    title: "Xác nhận xóa",
                    text: "Bạn có muốn xóa quyền này",
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
	                            url: "permission/"+id,
	                            async: true,
	                            data: {
	                                id: id,
	                            },
	                            success: function (response) {
	                                if(response){
	                                    swal(
	                                      'Đã xóa!',
	                                      'Bạn đã xóa quyền thành công!',
	                                      'success'
	                                    )
	                                    $('.permission-data-'+id).remove();
	                                }
	                            }
	                        });
	                    }
	                },2000)
                })
            }); 
        })
	</script>
@endsection