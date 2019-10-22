
@extends('layouts.layout_admin')

@section('content')
	<div class="row">
	    <div class="col-sm-12">
	    	<div class="col-sm-8">
                <h3>Danh sách Permission</h3>
            </div>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="searchPermission" id="search-permission" style="margin-top: 20px;" placeholder="Please enter keyword..." onkeyup="searchPermission()">
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
    	                <th>#</th>
    	                <th width="100px">Name</th>
    	                <th>Display name</th>
    	                <th>Description</th>
    	                <th colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
    	          	@if(isset($permissions) && isset($prs))
    		          	@foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
    			                <td>{{ $permission->name }}</td>
    			                <td>{{ $permission->display_name }}</td>
    			                <td>{{ $permission->description }}</td>
    			                <td>
    			                	<?php 
    			                		$checked = '';
    				                	foreach($prs as $pr){
    					                	if($pr->permission_id == $permission->id){
    					                		$checked = 'checked';
    					                	}
    					                }
    					             ?>
    					            
                                    <div class="pretty p-icon p-smooth" style="margin-top:3px;font-size: 20px;">
                                        <input type="checkbox" name="active" class="active-permission custom-checkbox" data-permission-id="{{ $permission->id }}" {{ $checked }}>
                                        <div class="state p-success">
                                            <i class="icon fa fa-check"></i>
                                            <label></label>
                                        </div>
                                    </div>
    				               	<input type="hidden" name="role_id" class="role_id" value="{{ $role->id }}">
    			                </td>
                            </tr>
    			        @endforeach
    			    @endif
                </tbody>
            </table>
            <div class="col-sm-12">
                @if(!empty($permissions))
                    {{$permissions->links()}}
                @endif
            </div>
            <a href="{{ route('roleBackPage') }}" class="btn btn-success" style="width: 120px; "><i class="fa fa-reply" aria-hidden="true"></i></a>
	    </div>
	</div>
	<script>
        $(document).ready(function(){
            $(document).on('change','.active-permission',function(e){
                var value3 = $(this).val();
                var obj = $(this);
                e.preventDefault();
                var permission_id = $(this).attr('data-permission-id');
                if(obj.is(':checked')){
                    swal({
                        title: "Xác nhận",
                        text: "Bạn có muốn xác nhận quyền này",
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
                                url: "pick-permission/"+permission_id,
                                async: true,
                                data: {
                                    role_id: $('.role_id').val(),
                                },
                                success: function (response) {
                                    if(response){
                                        setTimeout(function(){
                                            swal(
                                              'Thành công!',
                                              'Xác nhận quyền thành công!',
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
            $(document).on('change','.active-permission',function(e){
                var value3 = $(this).val();
                var obj = $(this);
                e.preventDefault();
                var permission_id = $(this).attr('data-permission-id');
                if(!obj.is(':checked')){
                    swal({
                        title: "Hủy xác nhận",
                        text: "Bạn có muốn hủy xác nhận quyền này",
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
                                url: "unpick-permission/"+permission_id,
                                async: true,
                                data: {
                                    role_id: $('.role_id').val(),
                                },
                                success: function (response) {
                                    if(response){
                                        setTimeout(function(){
                                            swal(
                                              ' Hủy',
                                              'Hủy xác nhận quyền thành công!',
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
        function searchPermission(){
            $(document).ready(function(){
                var r_id = $(".role_id").val()
                var searchPermission = $("#search-permission").val();

                $.ajax({
                    type: 'GET',
                    url : 'admin/permission-search/'+r_id,
                    data: {'searchPermission': searchPermission},
                    success:function(data){
                        $('tbody').html(data);
                    }
                })

            })
        }
    </script>
@endsection