@extends('layouts.layout_admin')

@section('content')
	<div class="row">
        <div class="col-sm-12">
           <h3>Thêm mới Docs API <small><a class="text-primary" id="getDraft" style="cursor:pointer; display: none"> Fill dữ liệu nháp</a></small></h3>
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
            <form id="form-submit" class="form-horizontal" action="{{ route('document.store') }}" method="POST" role="form">
           	    {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" placeholder="Title..." value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" name="menu_id" required>
                            <option disabled value="" selected>Mời bạn chọn menu</option>
                            @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->menu_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description: </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="summernote" name="content">{!! old('content') !!}</textarea>
                        @if ($errors->has('content'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">URI & Method: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="url" placeholder="Url..." value="{{ old('url') }}">
                        @if ($errors->has('url'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                     </div>
                     <div class="col-sm-5">
                          <select class="form-control" name="method" required>
                            <option disabled value="" selected>Mời bạn chọn phương thức</option>
                            <option value="1">GET</option>
                            <option value="2">POST</option>
                            <option value="3">PUT</option>
                            <option value="4">PATCH</option>
                            <option value="5">DELETE</option>
                        </select>
                        @if ($errors->has('method'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('method') }}</strong>
                            </span>
                        @endif
                     </div>
                </div>
              
                <div class="form-group">
                    <label class="col-sm-2 control-label">Parameters:</label>
                    <div class="box-param col-sm-10">
                    @if(count(old('description_parameter_key'))>0)
                        @foreach(old('description_parameter_key') as $key=>$value)
                        <div class="parameter_list row row-pad5" style="margin-top:5px;" id="list_params">
                        
                            <div class="col-md-2">
                               <input type="text" class="form-control" name="description_parameter_key[]" class="param-key" placeholder="key..." value="{{ old('description_parameter_key')[$key] }}" />
                            </div>

                            <div class="col-md-2">
    	                       <input type="text" class="form-control" name="description_parameter_value[]" class="param-value" placeholder="value..." value="{{ old('description_parameter_value')[$key] }}" />
    	                       </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="description_parameter_description[]" class="param-description" placeholder="description..." value="{{ old('description_parameter_description')[$key] }}" />
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="description_parameter_data_type[]">
                                    <option value="string" {{ old('description_parameter_data_type')[$key] == 'string' ? 'selected' : ''}}>STRING</option>
                                    <option value="json" {{ old('description_parameter_data_type')[$key] == 'json' ? 'selected' : ''}}>JSON</option>
                                    <option value="integer" {{ old('description_parameter_data_type')[$key] == 'integer' ? 'selected' : ''}}>INTEGER</option>
                                    <option value="float" {{ old('description_parameter_data_type')[$key] == 'float' ? 'selected' : ''}}>FLOAT</option>
                                    <option value="boolean" {{ old('description_parameter_data_type')[$key] == 'boolean' ? 'selected' : ''}}>BOOLEAN</option>
                                    <option value="array" {{ old('description_parameter_data_type')[$key] == 'array' ? 'selected' : ''}}>ARRAY</option>
                                    <option value="object" {{ old('description_parameter_data_type')[$key] == 'object' ? 'selected' : ''}}>OBJECT</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <select class="form-control" name="description_parameter_required[]">
                                    <option value="option" {{ old('description_parameter_required')[$key] == 'option' ? 'selected' : ''}}>Option</option>
                                    <option value="required" {{ old('description_parameter_required')[$key] == 'required' ? 'selected' : ''}}>Required</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <span>
                                    @if($key == 0)
                                        <a class="btn btn-success plus"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    @else
                                        <a class='btn btn-danger delete_field' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a>
                                    @endif
                                </span>   
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="parameter_list row row-pad5" id="list_params">
                    
                        <div class="col-md-2">
                           <input type="text" class="form-control" name="description_parameter_key[]" class="param-key" placeholder="key..." value="" />
                        </div>

                        <div class="col-md-2">
                           <input type="text" class="form-control" name="description_parameter_value[]" class="param-value" placeholder="value..." value="" />
                           </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="description_parameter_description[]" class="param-description" placeholder="description..." value="" />
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="description_parameter_data_type[]">
                                <option value="string" selected>STRING</option>
                                <option value="json">JSON</option>
                                <option value="integer">INTEGER</option>
                                <option value="float">FLOAT</option>
                                <option value="boolean">BOOLEAN</option>
                                <option value="array">ARRAY</option>
                                <option value="object">OBJECT</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select class="form-control" name="description_parameter_required[]">
                                <option value="option">Option</option>
                                <option value="required" selected>Required</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <span>
                                <a class="btn btn-success plus"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </span>   
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Error:</label>
                    <div class="box-error col-md-10">
                        @if(count(old('error_code'))>0)
                        @foreach(old('error_code') as $key => $value)
                        <div class="error_list row" style='margin-top:5px;'>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="error_code[]" class="error-code" placeholder="error code..." value="{{ old('error_code')[$key] }}">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="error_description[]" class="error-description" placeholder="description..." value="{{ old('error_description')[$key] }}">
                            </div>
                            <div class="col-md-4">
                                @if($key == 0)
                                    <span><a class="btn btn-success plus-error" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                                @else
                                    <span><a class='btn btn-danger delete_field_error' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @else
                            <div class="error_list row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="error_code[]" class="error-code" placeholder="error code..." value="">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="error_description[]" class="error-description" placeholder="description..." value="">
                            </div>
                            <div class="col-md-4">
                                <span><a class="btn btn-success plus-error" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Header:</label>
                    <div class="box-header col-md-10">
                        @if(count(old('header_key')) > 0)
                            @foreach(old('header_key') as $key => $value)
                            <div class="header_list row" style='margin-top:5px;'>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="header_key[]" class="header-key" placeholder="header key..." value="{{ old('header_key')[$key] }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="header_value[]" class="header-value" placeholder="header value..." value="{{ old('header_value')[$key] }}">
                                </div>
                                <div class="col-md-4">
                                    @if($key == 0)
                                        <span><a class="btn btn-success plus-header" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                                    @else
                                        <span><a class='btn btn-danger delete_field_header' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="header_list row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="header_key[]" class="header-key" placeholder="header key..." value="" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="header_value[]" class="header-value" placeholder="header value..." value="" >
                                </div>
                                <div class="col-md-4">
                                    <span><a class="btn btn-success plus-header" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Data Return:</label>
                    <div class="col-md-10">
                        <textarea name="data_return" value="{{ old('data_return') }}" id="data_return_value" class="form-control" cols="30" rows="10">{!! old('data_return') !!}</textarea>
                    </div>
                </div> 
                <div class="form-group">
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" class="form-control" name="active" value="1">
                </div>
                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function populate(frm, data) {
            var $des_params = {};
            $.each(data, function(key, value) {
                if(key.indexOf("description_parameter") >= 0 && value.length) {
                    var $key_name = key.replace("[]", "");
                    for(var i = 0; i < value.length; i++){
                        if($des_params[i] && $des_params[i].length) {}
                        else $des_params[i] = {};
                        $des_params[i][$key_name] = value[i];
                    }
                    console.log($key_name, value);
                }else {
                    var ctrl = $('[name="'+key+'"]', frm);
                    if (ctrl.is('select')){
                        $('option', ctrl).each(function() {
                            if (this.value == value)
                                this.selected = true;
                        });
                    } else if (ctrl.is('textarea')) {
                        ctrl.val(value);
                    } else {
                        switch (ctrl.prop("type")) {
                            case "radio":
                            case "checkbox":
                                ctrl.each(function () {
                                    if ($(this).attr('value') == value) $(this).attr("checked", true);
                                });
                                break;
                            default:
                                ctrl.val(value);
                        }
                    }
                }
            });
            if ($des_params && $des_params.length) {
                $('.box-param').empty();
                for (var i = 0; i < $des_params; i++) {
                    var html = '';
                    html += "<div class='parameter_list row row-pad5' style='margin-bottom:5px;'>";
                    html += "<div class='col-md-2'><input class='form-control' type='text' name='description_parameter_key[]' class='param-key' placeholder='key...' valude='" + $des_params[i]['description_parameter_key'] + "'></div>";
                    html += "<div class='col-md-2'><input class='form-control' type='text' name='description_parameter_value[]' class='param-value' placeholder='value...' value='" + $des_params[i]['description_parameter_value'] + "'></div>";
                    html += "<div class='col-md-2'><input class='form-control' type='text' name='description_parameter_description[]' class='param-description' placeholder='description...' value='" + $des_params[i]['description_parameter_description'] + "'></div>";
                    html += "<div class='col-md-2'><input class='form-control' type='text' name='description_parameter_data_type[]' class='param-data-type' placeholder='Data type...' value='" + $des_params[i]['description_parameter_data_type'] + "'></div>";
                    html += '<div class="col-md-2"><select class="form-control" name="description_parameter_data_type[]">' +
                        '                                <option value="string" ' + (($des_params[i]['description_parameter_data_type'] == 'string') ? 'selected' : '') + '>STRING</option>' +
                        '                                <option value="json" ' + (($des_params[i]['description_parameter_data_type'] == 'json') ? 'selected' : '') + '>JSON</option>' +
                        '                                <option value="integer" ' + (($des_params[i]['description_parameter_data_type'] == 'integer') ? 'selected' : '') + '>INTEGER</option>' +
                        '                                <option value="float" ' + (($des_params[i]['description_parameter_data_type'] == 'float') ? 'selected' : '') + '>FLOAT</option>' +
                        '                                <option value="boolean" ' + (($des_params[i]['description_parameter_data_type'] == 'boolean') ? 'selected' : '') + '>BOOLEAN</option>' +
                        '                                <option value="array" ' + (($des_params[i]['description_parameter_data_type'] == 'array') ? 'selected' : '') + '>ARRAY</option>' +
                        '                                <option value="object" ' + (($des_params[i]['description_parameter_data_type'] == 'object') ? 'selected' : '') + '>OBJECT</option>' +
                        '                            </select></div>';
                    html += "<div class='col-md-2'><input class='form-control' type='text' name='description_parameter_required[]' class='param-required' placeholder='Required...' value='" + $des_params[i]['description_parameter_required'] + "'></div>";
                    html += '<div class="col-md-2"><select class="form-control" name="description_parameter_required[]">' +
                        '                                <option value="option" ' + (($des_params[i]['description_parameter_required'] == 'option') ? 'selected' : '') + '>Option</option>' +
                        '                                <option value="required" ' + (($des_params[i]['description_parameter_required'] == 'required') ? 'selected' : '') + '>Required</option>' +
                        '                            </select></div>';
                    html += "<div class='col-md-2'><span><a class='btn btn-danger delete_field' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span></div>";
                    html += "</div>";
                    $('.box-param').append(html);
                }
            }
            console.log($des_params);
        }
        $.fn.serializeObject = function () {
            var o = localStorage.getItem('draftData') ? JSON.parse(localStorage.getItem('draftData')) : {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    if (this.value && this.value.length) {
                        if (this.name.indexOf("[]") >= 0) o[this.name].push(this.value);
                        else o[this.name] = this.value;
                    }
                } else {
                    if (this.value && this.value.length) o[this.name] = this.value;
                }
            });
            return o;
        };

        function saveDraftData() {
            localStorage.setItem('draftData', JSON.stringify($('#form-submit').serializeObject()));
        }
        $(document).ready(function(){
            $('.plus').click(function(e){
                var html = '';
                html += "<div class='parameter_list row row-pad5' style='margin-top:5px;'>";
                html += "<div class='col-md-2'><input class='form-control' type='text' name='description_parameter_key[]' class='param-key' placeholder='key...' valude=''></div>";
                html += "<div class='col-md-2'><input class='form-control' type='text' name='description_parameter_value[]' class='param-value' placeholder='value...' value=''></div>";
                html += "<div class='col-md-2'><input class='form-control' type='text' name='description_parameter_description[]' class='param-description' placeholder='description...'></div>";
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

                $('.box-param').append(html)
            });

            $('.plus-error').click(function(e){
                var html = '';
                html += "<div class='error_list row row-pad5' style='margin-top:5px;'>";
                html += "<div class='col-md-4'><input type='text' name='error_code[]' class='error-code form-control' placeholder='error code...'></div>";
                html += "<div class='col-md-4'><input type='text' name='error_description[]' class='error-description form-control' placeholder='description...'></div>";
                html += "<div class='col-md-4'><span><a class='btn btn-danger delete_field_error' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span></div>";
                html += "</div>";

                $('.box-error').append(html)
            });


            $('.plus-header').click(function(e){
                var html = '';
                html += "<div class='header_list row row-pad5' style='margin-top:5px;'>";
                html += "<div class='col-md-4'><input type='text' name='header_key[]' class='header-key form-control' placeholder='header key...'></div>";
                html += "<div class='col-md-4'><input type='text' name='header_value[]' class='header-value form-control' placeholder='header value...'></div>";
                html += "<div class='col-md-4'><span><a class='btn btn-danger delete_field_header' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span></div>";
                html += "</div>";

                $('.box-header').append(html)
            });

            $('#getDraft').on('click', function () {
                populate('#form-submit', JSON.parse(localStorage.getItem('draftData')));
                localStorage.setItem('draftData', '');
            });

            setInterval(function(){
                saveDraftData();
                if (localStorage.getItem('draftData')) $('#getDraft').show();
            }, 30000);
        });
        $('body').on('click','.delete_field',function(e){
            e.preventDefault();
            $(this).parents('.parameter_list').remove();
        });
        $('body').on('click','.delete_field_error',function(e){
            e.preventDefault();
            $(this).parents('.error_list').remove();
        });
        $('body').on('click','.delete_field_header',function(e){
            e.preventDefault();
            $(this).parents('.header_list').remove();
        });
    </script>
@endsection