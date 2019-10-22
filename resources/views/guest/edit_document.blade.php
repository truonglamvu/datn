@extends('layouts.layout')

@section('content')
	<div class="row">
        <div class="col-sm-9">
           <h3>Cập nhật Docs API</h3>
        </div>
        <div class="col-sm-9">
           <form action="{{ route('document.update',$doc->id) }}" method="POST" role="form">
           	{{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="form-group">
                 <label for="">Title</label>
                 <input type="text" class="form-control" name="title" value="{{ $doc->title }}" required>
              </div>

              <div class="form-group">
                 <label for="">Content</label>
                 <textarea class="form-control" name="content" required>{{ $doc->content }}</textarea>
              </div>

              <div class="form-group">
                 <label for="">Url</label>
                 <input type="text" class="form-control" name="url" value="{{ $doc->url }}" required>
              </div>

              <div class="form-group">
                 <p>Description parameter</p>
                 <div class="box_param">
                    @foreach($doc->description_parameter as $param)
                        <div class="parameter_list" style="margin-top:10px;">
        	                <input type="text" name="description_parameter[0][key]" class="param-key" value="{{ $param['key'] }}" required>
        	                <input type="text" name="description_parameter[0][value]" class="param-value" value="{{ $param['value'] }}" required>
        	                <input type="text" name="description_parameter[0][description]" class="param-description" value="{{ $param['description'] }}" required>
                        </div>
                    @endforeach
                 </div>
                 <span><a class="btn btn-success plus" style="color: white; margin-top: 10px;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
              </div>
              
              <div class="form-group">
                  <div class="box_error">
                    @foreach($doc->error as $error)
                        <div class="error_list" style="margin-top:10px;">
                            <input type="text" name="error[0][error_code]" class="error-code" value="{{ $error['error_code'] }}" required>
                            <input type="text" name="error[0][description]" class="error-description" value="{{ $error['description'] }}" required>
                        </div>
                    @endforeach
                 </div>
                 <span><a class="btn btn-success plus-error" style="color: white; margin-top: 10px;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
              </div>

              <div class="form-group">
                 <label for="">Method</label>
                 <select class="form-control" name="method" required>
                    <option value="{{ $doc->method }}">{{ $doc->method }}</option>
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
                    <option value="{{ $menu->id }}">{{ $menu->menu_name }}</option>
                    @foreach($menuLists as $menuList)
                      <option value="{{ $menuList->id }}">{{ $menuList->menu_name }}</option>
                    @endforeach
                 </select>
              </div>

              <div class="form-group">
                <input type="hidden" class="form-control" name="role_id" value="1">
                <input type="hidden" class="form-control" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" class="form-control" name="active" value="0">
              </div>

              <button type="submit" class="btn btn-primary" style="float:right;">Cập nhật</button>
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

                $('.box_param').append(html)
           });
            $('.plus-error').click(function(e){
                var number1 = $('.error-code').length;
                number1 = number1 +1;
                var html = '';
                html += "<div class='field_error' style='margin-top:5px;'>";
                html += "<input type='text' name='error["+number1+"][key]' class='error-code' placeholder='error code...'>";
                html += "<input style='margin-left:4px;' type='text' name='error["+number1+"][value]' class='error-description' placeholder='description...'>";
                html += "<span><a class='btn btn-danger delete_field_error' style='color: white;margin-left:5px;'><i class='fa fa-minus' aria-hidden='true'></i></a></span>";
                html += "</div>";

                $('.error_list').append(html)
           });
        });
        $('body').on('click','.delete_field',function(e){
            e.preventDefault();
            $(this).parents('.field').remove();
       });
        $('body').on('click','.delete_field_error',function(e){
            e.preventDefault();
            $(this).parents('.field_error').remove();
       });
    </script>
@endsection