@extends('layouts.layout_admin')

@section('content')
	<div class="row">
        <div class="col-sm-12">
           <h3>Cập nhật Docs API</h3>
           <hr>
           @if(count($errors) > 0)
               <div class="alert alert-danger">
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li><font color="red">(*)</font>{{ $error }}</li>
                        @endforeach
                    </ul>
               </div>
           @endif
        </div>
        <div class="col-sm-12">
            <form id="form-submit" class="form-horizontal" action="{{ route('document.update',$doc->id) }}" method="POST" role="form">
           	    {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label class="col-sm-2 control-label" >Title</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" value="{{ $doc->title }}">
                        @if ($errors->has('title'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" name="menu_id" required>
                            @foreach($menuLists as $menuList)
                                <option value="{{ $menuList->id }}" {{ ($menu->id === $menuList->id) ? 'selected' : '' }}>{{ $menuList->menu_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Content</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="summernote" name="content">{{ $doc->content }}</textarea>
                        @if ($errors->has('content'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">URL & Method: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="url" value="{{ $doc->url }}">
                        @if ($errors->has('url'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-5">
                        <select class="form-control" name="method" required>
                            <option value="1" {{($doc->method == 1) ? 'selected' : ''}}>GET</option>
                            <option value="2" {{($doc->method == 2) ? 'selected' : ''}}>POST</option>
                            <option value="3" {{($doc->method == 3) ? 'selected' : ''}}>PUT</option>
                            <option value="4" {{($doc->method == 4) ? 'selected' : ''}}>PATCH</option>
                            <option value="5" {{($doc->method == 5) ? 'selected' : ''}}>DELETE</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Parameters: </label>
                    <div class="box_param col-sm-10">
                        <?php $count_param = 1; ?>
                        @foreach($doc->description_parameter as $param)
                            @if($count_param == 1)
                                <div class="parameter_list row row-pad5" style="margin-top:10px;">
                                    <div class="col-md-2">
                	                   <input type="text" name="description_parameter_key[]" class="param-key form-control" value="{{ $param['key'] }}">
                                    </div>

                                    <div class="col-md-2">
                	                   <input type="text" name="description_parameter_value[]" class="param-value form-control" value="{{ $param['value'] }}">
                                    </div>

                                    <div class="col-md-2">
                	                   <input type="text" name="description_parameter_description[]" class="param-description form-control" value="{{ $param['description'] }}">
                                    </div>

                                    <div class="col-md-2">
                                        @if(isset($param['data_type']))
                                            <select class="form-control" name="description_parameter_data_type[]" required>
                                                <option value="string" {{($param['data_type'] == "string") ? 'selected' : ''}}>STRING</option>
                                                <option value="json" {{($param['data_type'] == "json") ? 'selected' : ''}}>JSON</option>
                                                <option value="integer" {{($param['data_type'] == "integer") ? 'selected' : ''}}>INTEGER</option>
                                                <option value="float" {{($param['data_type'] == "float") ? 'selected' : ''}}>FLOAT</option>
                                                <option value="boolean" {{($param['data_type'] == "boolean") ? 'selected' : ''}}>BOOLEAN</option>
                                                <option value="array" {{($param['data_type'] == "array") ? 'selected' : ''}}>ARRAY</option>
                                                <option value="object" {{($param['data_type'] == "object") ? 'selected' : ''}}>OBJECT</option>
                                            </select>
                                        @else
                                            <select class="form-control" name="description_parameter_data_type[]" required>
                                                <option value="string" selected>STRING</option>
                                                <option value="json">JSON</option>
                                                <option value="integer">INTEGER</option>
                                                <option value="float">FLOAT</option>
                                                <option value="boolean" >BOOLEAN</option>
                                                <option value="array">ARRAY</option>
                                                <option value="object">OBJECT</option>
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        @if(isset($param['required']))
                                            <select class="form-control" name="description_parameter_required[]" required>
                                                <option value="option" {{($param['required'] == "option") ? 'selected' : ''}}>Option</option>
                                                <option value="required" {{($param['required'] == "required") ? 'selected' : ''}}>Required</option>
                                            </select>
                                        @else
                                            <select class="form-control" name="description_parameter_required[] " required>
                                                <option value="option">Option</option>
                                                <option value="required" selected>Required</option>
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <span><a class="btn btn-success plus" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                                    </div>
                                </div>
                            @else
                                <div class="parameter_list row row-pad5" style="margin-top:10px;">
                                    <div class="col-md-2">
                                        <input type="text" name="description_parameter_key[]" class="param-key form-control" value="{{ $param['key'] }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="description_parameter_value[]" class="param-value form-control" value="{{ $param['value'] }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="description_parameter_description[]" class="param-description form-control" value="{{ $param['description'] }}">
                                    </div>
                                    <div class="col-md-2">
                                        @if(isset($param['data_type']))
                                            <select class="form-control" name="description_parameter_data_type[]" required>
                                                <option value="string" {{($param['data_type'] == "string") ? 'selected' : ''}}>STRING</option>
                                                <option value="json" {{($param['data_type'] == "json") ? 'selected' : ''}}>JSON</option>
                                                <option value="integer" {{($param['data_type'] == "integer") ? 'selected' : ''}}>INTEGER</option>
                                                <option value="float" {{($param['data_type'] == "float") ? 'selected' : ''}}>FLOAT</option>
                                                <option value="boolean" {{($param['data_type'] == "boolean") ? 'selected' : ''}}>BOOLEAN</option>
                                                <option value="array" {{($param['data_type'] == "array") ? 'selected' : ''}}>ARRAY</option>
                                                <option value="object" {{($param['data_type'] == "object") ? 'selected' : ''}}>OBJECT</option>
                                            </select>
                                        @else
                                            <select class="form-control" name="description_parameter_data_type[]" required>
                                                <option value="string" >STRING</option>
                                                <option value="json" >JSON</option>
                                                <option value="integer" >INTEGER</option>
                                                <option value="float" >FLOAT</option>
                                                <option value="boolean" >BOOLEAN</option>
                                                <option value="array" >ARRAY</option>
                                                <option value="object" >OBJECT</option>
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        @if(isset($param['required']))
                                            <select class="form-control" name="description_parameter_required[]" required>
                                                <option value="option" {{($param['required'] == "option") ? 'selected' : ''}}>Option</option>
                                                <option value="required" {{($param['required'] == "required") ? 'selected' : ''}}>Required</option>
                                            </select>
                                        @else
                                            <select class="form-control" name="description_parameter_required[] " required>
                                                <option value="option" >Option</option>
                                                <option value="required" selected>Required</option>
                                            </select>
                                        @endif
                                    </div>

                                    <div class="col-md-2">
                                        <span><a class='btn btn-danger delete_field' style='color: white;margin-left:0px;'><i class='fa fa-minus' aria-hidden='true'></i></a></span>
                                    </div>
                                </div>
                            @endif
                            <?php $count_param++; ?>
                        @endforeach
                    </div>
                </div>

                @if($doc->error != null)
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Error</label>
                        <div class="box_error col-md-10">
                            <?php $count_error = 1;?>
                            @foreach($doc->error as $error)
                                @if($count_error == 1)
                                    <div class="error_list row" style="margin-top:10px;">
                                        <div class="col-md-4">
                                            <input type="text" name="error_code[]" class="error-code form-control" value="{{ $error['error_code'] }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="error_description[]" class="error-description form-control" value="{{ $error['description'] }}">
                                        </div>
                                        <div class="col-md-4">
                                            <span><a class="btn btn-success plus-error" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                                        </div>
                                    </div>
                                @else
                                    <div class="error_list row" style="margin-top:10px;">
                                        <div class="col-md-4">
                                            <input type="text" name="error_code[]" class="error-code form-control" value="{{ $error['error_code'] }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="error_description[]" class="error-description form-control" value="{{ $error['description'] }}">
                                        </div>
                                        <div class="col-md-4">
                                            <span><a class='btn btn-danger delete_field_error' style='color: white;margin-left:0px;'><i class='fa fa-minus' aria-hidden='true'></i></a></span>
                                        </div>
                                    </div>
                                @endif
                                <?php $count_error++;?>
                            @endforeach
                        </div>
                    </div>
                @else
                    <label class="col-sm-2 control-label">Error</label>
                    <div class="box_error col-md-10">
                        <div class="error_list row" style="margin-top:10px;">
                            <div class="col-md-4">
                                <input type="text" name="error_code[]" class="error-code form-control" placeholder="Error code...">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="error_description[]" class="error-description form-control" placeholder="Description error..." >
                            </div>
                            <div class="col-md-4">
                                <span><a class="btn btn-success plus-error" style="color: white; margin-top: 10px;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    
                @endif

                @if($doc->header != null)
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Header</label>
                        <div class="box_header col-md-10">
                            <?php $count_header = 1;?>
                            @foreach($doc->header as $header)
                                @if($count_header == 1)
                                    <div class="header_list row" style="margin-top:10px;">
                                        <div class="col-md-4">
                                            <input type="text" name="header_key[]" class="header-key form-control" value="{{ $header['header_key'] }}" >
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="header_value[]" class="header-value form-control" value="{{ $header['header_value'] }}" >
                                        </div>
                                        <div class="col-md-4">
                                            <span><a class="btn btn-success plus-header" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                                        </div>
                                    </div>
                                @else
                                    <div class="header_list row" style="margin-top:10px;">
                                        <div class="col-md-4">
                                            <input type="text" name="header_key[]" class="header-key form-control" value="{{ $header['header_key'] }}" >
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="header_value[]" class="header-value form-control" value="{{ $header['header_value'] }}" >
                                        </div>
                                        <div class="col-md-4">
                                            <span><a class='btn btn-danger delete_field_header' style='color: white;margin-left:0px;'><i class='fa fa-minus' aria-hidden='true'></i></a></span>
                                        </div>
                                    </div>
                                @endif
                                <?php $count_header++;?>
                            @endforeach
                        </div>
                    </div>
                @else
                    <label class="col-sm-2 control-label">Header</label>
                    <div class="box_header col-md-10">
                        <div class="header_list row" style="margin-top:10px;">
                            <div class="col-md-4">
                                <input type="text" name="header_key[]" class="header-key form-control" placeholder="header key..." >
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="header_value[]" class="header-value form-control" placeholder="header value..." >
                            </div>
                            <div class="col-md-4">
                                <span><a class="btn btn-success plus-header" style="color: white; margin-top: 10px;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                    </div>
                    
                @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label">Data return</label>
                    <div class="col-md-10">
                        <textarea id="data_return_value" class="form-control" cols="30" rows="10" name="data_return">{{ $doc->data_return }}</textarea>
                        @if ($errors->has('data_return'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('data_return') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" class="form-control" name="active" value="1">
                </div>

                <button type="submit" class="btn btn-primary" style="float:right;">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection
@section('js-footer')
<script type="text/javascript">
        $(document).ready(function(){
            $('.plus').click(function(e){
                var html = '';
                html += "<div class='parameter_list row row-pad5' style='margin-top:5px;'>";
                html += "<div class='col-md-2'><input type='text' name='description_parameter_key[]' class='param-key form-control' placeholder='key...'></div>";
                html += "<div class='col-md-2'><input type='text' name='description_parameter_value[]' class='param-value form-control' placeholder='value...'></div>";
                html += "<div class='col-md-2'><input type='text' name='description_parameter_description[]' class='param-description form-control' placeholder='description...'></div>";
                html += '<div class="col-md-2"><select class="form-control" name="description_parameter_data_type[]">' +
                    '                                <option value="string" selected>STRING</option>' +
                    '                                <option value="json">JSON</option>' +
                    '                                <option value="integer">INTEGER</option>' +
                    '                                <option value="float">FLOAT</option>' +
                    '                                <option value="boolean">BOOLEAN</option>' +
                    '                                <option value="array">ARRAY</option>' +
                    '                                <option value="object">OBJECT</option>' +
                    '                            </select></div>';
                html += '<div class="col-md-2"><select class="form-control" name="description_parameter_required[]">' +
                    '                                <option value="option">Option</option>' +
                    '                                <option value="required" selected>Required</option>' +
                    '                            </select></div>';
                html += "<div class='col-md-2'><span><a class='btn btn-danger delete_field' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span></div>";
                html += "</div>";
                $('.box_param').append(html)
            });
            $('.plus-error').click(function(e){
                var html = '';
                html += "<div class='error_list row' style='margin-top:5px;'>";
                html += "<div class='col-md-4'><input type='text' name='error_code[]' class='error-code form-control' placeholder='Error code...'></div>";
                html += "<div class='col-md-4'><input type='text' name='error_description[]' class='error-description form-control' placeholder='Description error...'></div>";
                html += "<div class='col-md-4'><span><a class='btn btn-danger delete_field_error' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span></div>";
                html += "</div>";

                $('.box_error').append(html)
            });
            $('.plus-header').click(function(e){
                var html = '';
                html += "<div class='header_list row' style='margin-top:5px;'>";
                html += "<div class='col-md-4'><input type='text' name='header_key[]' class='header-key form-control' placeholder='header key...'></div>";
                html += "<div class='col-md-4'><input type='text' name='header_value[]' class='header-value form-control' placeholder='header value...'></div>";
                html += "<div class='col-md-4'><span><a class='btn btn-danger delete_field_header' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span></div>";
                html += "</div>";

                $('.box_header').append(html)
            });
        });
        $('body').on('click', '.delete_field', function(e){
            e.preventDefault();
            $(this).parents('.parameter_list').remove();
        });
        $('body').on('click', '.delete_field_error', function(e){
            e.preventDefault();
            $(this).parents('.error_list').remove();
        });
        $('body').on('click', '.delete_field_header', function(e){
            e.preventDefault();
            $(this).parents('.header_list').remove();
        });
    </script>
    <script type="text/javascript">
        CKEDITOR.replace( '.ckeditor' );
    </script>
@endsection