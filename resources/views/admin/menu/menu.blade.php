@extends('layouts.layout_admin')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h3 align="center" style="padding-bottom: 10px;">Danh sách quản lý Menu</h3>
        </div>
        <a href="{{ route('menu.create') }}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i> Thêm mới</a>
    </div>
    <br />
    <div class="row">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th width="300px">Menu name</th>
                    <th width="300px">Type</th>
                    <th width="300px">Route</th>
                    <th colspan="3" style="text-align: center;width: 210px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($menus))
                    @foreach($menus as $menu)
                        <tr class="menu-data-{{ $menu->id }}">
                            <td>{{ $menu->id }}</td>
                            <td>{{ $menu->menu_name }}</td>
                            <td>{{ $menu->type }}</td>
                            <td>{{ $menu->route }}</td>
                            <td>
                                <a href="{{ route('loadRoleMenu',$menu->id) }}" class="btn btn-info"><i class="fa fa-list-alt" aria-hidden="true"></i> List role</a>
                                <a href="{{ route('menu.edit',$menu->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></a>
                                <form method="POST" style="display: inline-block; margin: 0 5px">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE')}}
                                  <button data-menu-id="{{ $menu->id }}" type="submit" class="btn btn-danger delete_menu"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        @if(!empty($menus))
            {{$menus->links()}}
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
            $(document).on('click','.delete_menu',function (e) {
                var value = $(this).val();
                e.preventDefault();
                var id = $(this).attr('data-menu-id');
                swal({
                    title: "Xác nhận xóa",
                    text: "Bạn có muốn xóa menu này",
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
                                url: "menu/"+id,
                                async: true,
                                data: {
                                    id: id,
                                },
                                success: function (response) {
                                    if(response){
                                        swal(
                                          'Đã xóa!',
                                          'Bạn đã xóa menu thành công!',
                                          'success'
                                        )
                                        $('.menu-data-'+id).remove();
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