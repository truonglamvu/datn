@extends('layouts.layout')

@section('content')
	<div class="row">
        <div class="col-sm-9">
           <h3>Thêm mới Docs API</h3>
        </div>
        <div class="col-sm-9">
           <form action="{{ route('document.store') }}" method="POST" role="form">
           	{{ csrf_field() }}
              <div class="form-group">
                 <label for="">Title</label>
                 <input type="text" class="form-control" name="title" placeholder="Title..." required>
              </div>

              <div class="form-group">
                 <label for="">Content</label>
                 <textarea class="form-control" name="content" required></textarea>
              </div>

              <div class="form-group">
                 <label for="">Url</label>
                 <input type="text" class="form-control" name="url" placeholder="Url..." required>
              </div>

              <div class="form-group">
                 <p>Description parameter</p>
                 <div class="parameter_list">
	                 <input type="text" name="description_parameter[0][key]" class="param-key" placeholder="key..." required>
	                 <input type="text" name="description_parameter[0][value]" class="param-value" placeholder="value..." required>
	                 <input type="text" name="description_parameter[0][description]" class="param-description" placeholder="description..." required>
	                 <span><a class="btn btn-success plus" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                 </div>
                 
              </div>

              <div class="form-group">
                 <label for="">Return Data:</label>
                 <textarea class="form-control" name="data_return" rows="10" required></textarea>
              </div>
              
              <div class="form-group">
                 <label for="">Error</label>
                 <input type="text" class="form-control" name="error" placeholder="Error..." required>
              </div>
              
              <div class="form-group">
                 <label for="">Description error</label>
                 <input type="text" class="form-control" name="description_error" placeholder="Error..." required>
              </div>

              <div class="form-group">
                 <label for="">Method</label>
                 <select class="form-control" name="method" required>
                    <option selected>Mời bạn chọn phương thức</option>
                    <option value="1">GET</option>
                    <option value="2">POST</option>
                    <option value="3">PUT</option>
                    <option value="4">PATCH</option>
                    <option value="5">DELETE</option>
                 </select>
              </div>

              <div class="form-group">
                 <label for="">Menu</label>
                 <select class="form-control" name="menu_id" required>
                    <option selected>Mời bạn chọn menu</option>
                    @foreach($menus as $menu)
                      <option value="{{ $menu->id }}">{{ $menu->menu_name }}</option>
                    @endforeach
                 </select>
              </div>

              <div class="form-group">
                <input type="hidden" class="form-control" name="role_id" value="1">
                <input type="hidden" class="form-control" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" class="form-control" name="active" value="0">
              </div>

              <button type="submit" class="btn btn-primary" style="float:right;">Thêm mới</button>
           </form>
        </div>
     </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.plus').click(function(e){
                var number = $('.param-key').length;
                number = number +1;
                var html = '';
                html += "<div class='field' style='margin-top:5px;'>";
                html += "<input type='text' name='description_parameter["+number+"][key]' class='param-key' placeholder='key...'>";
                html += "<input style='margin-left:4px;' type='text' name='description_parameter["+number+"][value]' class='param-value' placeholder='value...'>";
                html += "<input style='margin-left:4px;' type='text' name='description_parameter["+number+"][description]' class='param-description' placeholder='description...'>";
                html += "<span><a class='btn btn-danger delete_field' style='color: white;margin-left:5px;'><i class='fa fa-minus' aria-hidden='true'></i></a></span>";
                html += "</div>";

                $('.parameter_list').append(html)
           });
        });
        $('body').on('click','.delete_field',function(e){
            e.preventDefault();
            $(this).parents('.field').remove();
       });
    </script>
@endsection