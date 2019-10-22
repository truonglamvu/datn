@extends('layouts.layout_admin')

@section('content')
    <div class="row">
        <form id="search-form" class="row">
            <div class="col-lg-12">
                 <h1 class="page-header">
                    Danh sách quản lý API
                </h1>
            </div>
            <div class="col-sm-5">
                <input type="text" name="search" class="form-control" id="search" placeholder="Enter title, url"
                       onkeyup="searchDocs()" autocomplete="off" value="{{!empty(Request::get('search')) ? Request::get('search') : ''}}">
            </div>
            <div class="col-sm-3">
                <select class="form-control" name="user_id" onchange="searchDocs()">
                    <option value="" {{empty(Request::get('user_id')) ? 'selected' : ''}}>Tất cả User</option>
                    @foreach ($users as $u)
                    <option value="{{$u->id}}" {{ (Request::get('user_id') == $u->id) ? 'selected' : ''}}>{{$u->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-control" name="menu_id" onchange="searchDocs()">
                    <option value="" {{empty(Request::get('menu_id')) ? 'selected' : ''}}>Tất cả Menu</option>
                    @foreach ($menus as $m)
                    <option value="{{$m->id}}" {{ (Request::get('menu_id') == $u->id) ? 'selected' : ''}}>{{$m->menu_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                <a href="{{ route('document.create') }}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
            </div>
            <input type="hidden" name="limit" value="{{!empty(Request::get('limit')) ? Request::get('limit') : '10'}}">
        </form>
    </div>
    <br>
	<div class="row" id="list_docs">
        @include('admin.document.elements.list_api_docs')
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
        $(function(){
            $(document).on('change','.change-status',function (e) {
                var value = $(this).val();
                var obj = $(this);
                e.preventDefault();
                var id = $(this).attr('data-post-id');
                if(obj.is(':checked')){
                  var titleSwal = "Xác nhận!";
                  var textSwal = "Bạn có muốn xác nhận bài viết này";
                }else{
                  var titleSwal = "Hủy xác nhận!";
                  var textSwal = "Bạn có muốn hủy xác nhận bài viết này";
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
                            url: "document/active/"+id,
                            async: true,
                            data: {
                                status: value,
                            },
                            success: function (response) {
                                if(response.value){
                                    setTimeout(function(){
                                        swal(
                                          'Xác nhận!',
                                          'Bạn đã xác nhận bài viết',
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
                                          'Bạn đã hủy xác nhận bài viết',
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
                        if(value == 1){
                            obj.prop('checked',true);
                        }
                        else{
                            obj.prop('checked',false);
                        }
                    }   
                })
            });
            $(document).on('click','.delete-post',function (e) {
                var value = $(this).val();
                e.preventDefault();
                var id = $(this).attr('data-post-id');
                swal({
                        title: "Xác nhận xóa",
                        text: "Bạn có muốn xóa bài viết này",
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
                                    url: "document/"+id,
                                    async: true,
                                    data: {
                                        id: id,
                                    },
                                    success: function (response) {
                                        if(response){
                                            swal(
                                                'Đã xóa!',
                                                'Bạn đã xóa bài viết thành công!',
                                                'success'
                                            )
                                            $('.document-data-'+id).remove();
                                        }
                                    }
                                });
                            }
                        },2000);
                    })
            });
        });
        var xhr;
        function searchDocs(){
            if(xhr && xhr.readystate != 4){
                xhr.abort();
            }
            $('#search-form input[name="limit"]').val($('#limit_record').val());
            xhr = $.ajax({
                type: 'GET',
                url : '{{URL::to('admin/document-search')}}',
                data: $('#search-form').serialize(),
                success:function(data){
                    $('#list_docs').html(data);
                }
            })
        }
        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            searchDocs();
        });
    </script>
@endsection