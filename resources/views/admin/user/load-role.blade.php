@extends('layouts.layout_admin')

@section('content')
	<div class="row">
	    <div class="col-sm-12">
	    	<div class="col-sm-6">
		       <h3>Danh sách Role</h3>
	       </div>
	       <div class="col-sm-6">
	        	<input type="text" class="form-control" name="searchRole" id="search-role" style="margin-top: 20px;" placeholder="Please enter keyword..." onkeyup="searchRole()">
	       </div>
	       <table class="table table-hover">
	          <thead>
	             <tr>
	                <th>#</th>
	                <th width="100px">Name</th>
	                <th>Display name</th>
	                <th>Description</th>
	                <th>Action</th>
	             </tr>
	          </thead>
	          <tbody>
	          	@if(isset($roles))
		          	@foreach($roles as $role)
			             <tr>
			                <td>{{ $role->id }}</td>
			                <td>{{ $role->name }}</td>
			                <td>{{ $role->display_name }}</td>
			                <td>{{ $role->description }}</td>
			                <td>
			                	<?php 
			                		$checked = '';
				                	foreach($urs as $ur){
					                	if($ur->role_id == $role->id){
					                		$checked = 'checked';
					                	}
					                }
					             ?>
					            
                                    <div class="pretty p-icon p-smooth" style="margin-top:3px;font-size: 20px;">
                                        <input type="checkbox" name="active" class="active-role custom-checkbox" data-role-id="{{ $role->id }}" {{ $checked }}>
                                        <div class="state p-success">
                                            <i class="icon fa fa-check"></i>
                                            <label></label>
                                        </div>
                                    </div>
				               	<input type="hidden" name="user_id" class="user_id" value="{{ $user->id }}">
		               		</td>
			             </tr>
			        @endforeach
			    @endif
	          </tbody>
	       </table>
           <div class="col-sm-12">
                @if(!empty($roles))
                    {{$roles->links()}}
                @endif
           </div>
           <a href="{{ route('userBackPage') }}" class="btn btn-success" style="width: 120px; "><i class="fa fa-reply" aria-hidden="true"></i></a>
	    </div>
	 </div>
	<script>
		$(document).ready(function(){
			$(document).on('change','.active-role',function(e){
                var value2 = $(this).val();
                var obj = $(this);
                e.preventDefault();
                var role_id = $(this).attr('data-role-id');
                if(obj.is(':checked')){
                    swal({
                        title: "Xác nhận",
                        text: "Bạn có muốn xác nhận vai trò này",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý!",
                        cancelButtonText: "Hủy",
                        showLoaderOnConfirm: true,
                        closeOnConfirm: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            $.ajax({
                                type: "POST",
                                url: "pick-role-store/"+role_id,
                                async: true,
                                data: {
                                    user_id: $('.user_id').val(),
                                },
                                success: function (response) {
                                    if(response){
                                        setTimeout(function(){
                                            swal(
                                              'Thành công!',
                                              'Xác nhận vai trò thành công!',
                                              'success'
                                            )
                                            obj.next('.state').addClass('p-success');
                                            obj.next('.state').find('.icon').addClass('fa-check');
                                            obj.prop('checked',true);
                                        },2000);
                                    }
                                }
                            });
                        }
                        else{
                            obj.prop('checked',false);
                        }
                    });
                }
            })
		})
	</script>
    <script>
        $(document).ready(function(){
            $(document).on('change','.active-role',function(e){
                var value2 = $(this).val();
                var obj = $(this);
                e.preventDefault();
                var role_id = $(this).attr('data-role-id');
                if(!obj.is(':checked')){
                    swal({
                        title: "Hủy xác nhận",
                        text: "Bạn có muốn hủy xác nhận vai trò này",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý!",
                        cancelButtonText: "Hủy",
                        showLoaderOnConfirm: true,
                        closeOnConfirm: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                           $.ajax({
                                type: "POST",
                                url: "unpick-role-store/"+role_id,
                                async: true,
                                data: {
                                    user_id: $('.user_id').val(),
                                },
                                success: function (response) {
                                    if(response){
                                        setTimeout(function(){
                                            swal(
                                              ' Hủy!',
                                              'Hủy xác nhận vai trò thành công!',
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
                            obj.prop('checked',true);
                        }
                    });
                }
            })
        })
    </script>
    <script type="text/javascript">
        function searchRole(){
            $(document).ready(function(){
                var id = $(".user_id").val()
                var searchRole = $("#search-role").val();

                $.ajax({
                    type: 'GET',
                    url : 'admin/role-search/'+id,
                    data: {'searchRole': searchRole},
                    success:function(data){
                        $('tbody').html(data);
                    }
                })

            })
        }
    </script>
@endsection