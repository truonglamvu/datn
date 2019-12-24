@extends('layouts.layout_guest')

@section('content')
  <div id="documenter_content" style="width: 60%">
        <div class="col-sm-12">
           <h3>Chạy thử nghiệm API </h3>
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
            <div id="form-submit" class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">URI & Method: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control url_api" name="url" placeholder="Url..." value="{{ old('url') }}">
                        @if ($errors->has('url'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                     </div>
                     <div class="col-sm-5">
                          <select class="form-control method_type" name="method" required>
                            <option disabled value="" selected>Mời bạn chọn phương thức</option>
                            <option value="GET">GET</option>
                            <option value="POST">POST</option>
                            <option value="PUT">PUT</option>
                            <option value="PATCH">PATCH</option>
                            <option value="DELETE">DELETE</option>
                        </select>
                        @if ($errors->has('method'))
                            <span class="help-block alert alert-danger">
                                <strong><font color="red">(*)</font> {{ $errors->first('method') }}</strong>
                            </span>
                        @endif
                     </div>
                </div>
              
                <div class="form-group default-parameter">
                    <label class="col-sm-2 control-label">Parameters:</label>
                    <div class="box-param col-sm-10">
                    @if(gettype(old('description_parameter_key')) != "NULL" && old('description_parameter_key')->count() > 0)
                        @foreach(old('description_parameter_key') as $key=>$value)
                        <div class="parameter_list row row-pad5" style="margin-top:5px;" id="list_params">
                        
                            <div class="col-md-2">
                               <input type="text" class="form-control param-key" name="description_parameter_key[]" placeholder="key..." value="{{ old('description_parameter_key')[$key] }}" />
                            </div>

                            <div class="col-md-2">
                             <input type="text" class="form-control param-value" name="description_parameter_value[]" placeholder="value..." value="{{ old('description_parameter_value')[$key] }}" />
                             </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control param-description" name="description_parameter_description[]" placeholder="description..." value="{{ old('description_parameter_description')[$key] }}" />
                            </div>
                            <div class="col-md-2">
                                <select class="form-control type_param" name="description_parameter_data_type[]">
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
                                <select class="form-control param_require" name="description_parameter_required[]">
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
                           <input type="text" class="form-control param-key" name="description_parameter_key[]" placeholder="key..." value="" />
                        </div>

                        <div class="col-md-2">
                           <input type="text" class="form-control param-value" name="description_parameter_value[]" placeholder="value..." value="" />
                           </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control param-description" name="description_parameter_description[]" placeholder="description..." value="" />
                        </div>
                        <div class="col-md-2">
                            <select class="form-control type_param" name="description_parameter_data_type[]">
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
                            <select class="form-control param_require" name="description_parameter_required[]">
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
                    <label class="col-sm-2 control-label">Header:</label>
                    <div class="box-header col-md-10">
                        @if(gettype(old('header_key')) != "NULL" && old('header_key')->count() > 0)
                            @foreach(old('header_key') as $key => $value)
                            <div class="header_list row" style='margin-top:5px;'>
                                <div class="col-md-4">
                                    <input type="text" class="form-control header-key" name="header_key[]" placeholder="header key..." value="{{ old('header_key')[$key] }}">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control header-value" name="header_value[]" placeholder="header value..." value="{{ old('header_value')[$key] }}">
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
                                    <input type="text" class="form-control header-key" name="header_key[]" placeholder="header key..." value="" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control header-value" name="header_value[]" placeholder="header value..." value="" >
                                </div>
                                <div class="col-md-4">
                                    <span><a class="btn btn-success plus-header" style="color: white;"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group box-response-data">
                    <label class="col-sm-2 control-label">Data Return:</label>
                    <div class="col-md-10">
                        <a class="form-control data-response" style="max-height: 400px; height: 400px; overflow: scroll; background-color: black;">
                            
                        </a>
                    </div>
                </div> 
                <div class="form-group">
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" class="form-control" name="active" value="1">
                </div>
                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary test-api">Run test</button>
                </div>
            </div>
            
        </div>
        <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-body text-center">
                <div class="loader"></div>
                <h4>Loading...</h4>
              </div>
            </div>
          </div>
        </div>
    </div>
    <style type="text/css">
        .background-actual{
            display:none;
        }
    </style>
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
                    html += "<div class='col-md-2'><input class='form-control param-key' type='text' name='description_parameter_key[]' placeholder='key...' valude='" + $des_params[i]['description_parameter_key'] + "'></div>";
                    html += "<div class='col-md-2'><input class='form-control param-value' type='text' name='description_parameter_value[]' placeholder='value...' value='" + $des_params[i]['description_parameter_value'] + "'></div>";
                    html += "<div class='col-md-2'><input class='form-control param-description' type='text' name='description_parameter_description[]' placeholder='description...' value='" + $des_params[i]['description_parameter_description'] + "'></div>";
                    html += "<div class='col-md-2'><input class='form-control type_param' type='text' name='description_parameter_data_type[]' class='param-data-type' placeholder='Data type...' value='" + $des_params[i]['description_parameter_data_type'] + "'></div>";
                    html += '<div class="col-md-2"><select class="form-control type_param" name="description_parameter_data_type[]">' +
                        '                                <option value="string" ' + (($des_params[i]['description_parameter_data_type'] == 'string') ? 'selected' : '') + '>STRING</option>' +
                        '                                <option value="json" ' + (($des_params[i]['description_parameter_data_type'] == 'json') ? 'selected' : '') + '>JSON</option>' +
                        '                                <option value="integer" ' + (($des_params[i]['description_parameter_data_type'] == 'integer') ? 'selected' : '') + '>INTEGER</option>' +
                        '                                <option value="float" ' + (($des_params[i]['description_parameter_data_type'] == 'float') ? 'selected' : '') + '>FLOAT</option>' +
                        '                                <option value="boolean" ' + (($des_params[i]['description_parameter_data_type'] == 'boolean') ? 'selected' : '') + '>BOOLEAN</option>' +
                        '                                <option value="array" ' + (($des_params[i]['description_parameter_data_type'] == 'array') ? 'selected' : '') + '>ARRAY</option>' +
                        '                                <option value="object" ' + (($des_params[i]['description_parameter_data_type'] == 'object') ? 'selected' : '') + '>OBJECT</option>' +
                        '                            </select></div>';
                    html += "<div class='col-md-2'><input class='form-control param_require' type='text' name='description_parameter_required[]' class='param-required' placeholder='Required...' value='" + $des_params[i]['description_parameter_required'] + "'></div>";
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

        $(document).ready(function(){
            $(".body-parameter").css('display','none');
            $(".default-parameter").css('display','block');
            $(".choose-type-param").change(function(){
                var type_param = $(this).val();
                if (type_param == "default"){
                    $(".body-parameter").css('display','none');
                    $(".default-parameter").css('display','block');
                } else if (type_param == "body") {
                    $(".body-parameter").css('display','block');
                    $(".default-parameter").css('display','none');
                }
            })
            $('.plus').click(function(e){
                var html = '';
                html += "<div class='parameter_list row row-pad5' style='margin-top:5px;'>";
                html += "<div class='col-md-2'><input class='form-control param-key' type='text' name='description_parameter_key[]' placeholder='key...' valude=''></div>";
                html += "<div class='col-md-2'><input class='form-control param-value' type='text' name='description_parameter_value[]' placeholder='value...' value=''></div>";
                html += "<div class='col-md-2'><input class='form-control param-description' type='text' name='description_parameter_description[]' placeholder='description...'></div>";
                html += '<div class="col-md-2"><select class="form-control type_param" name="description_parameter_data_type[]">' +
                    '                                <option value="string" selected>STRING</option>' +
                    '                                <option value="json">JSON</option>' +
                    '                                <option value="integer">INTEGER</option>' +
                    '                                <option value="float">FLOAT</option>' +
                    '                                <option value="boolean">BOOLEAN</option>' +
                    '                                <option value="array">ARRAY</option>' +
                    '                                <option value="object">OBJECT</option>' +
                    '                            </select></div>';
                html += '<div class="col-md-2"><select class="form-control param_require" name="description_parameter_required[]">' +
                    '                                <option value="option">Option</option>' +
                    '                                <option value="required" selected>Required</option>' +
                    '                            </select></div>';
                html += "<div class='col-md-2'><span><a class='btn btn-danger delete_field' style='color: white;'><i class='fa fa-minus' aria-hidden='true'></i></a></span></div>";
                html += "</div>";

                $('.box-param').append(html)
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

        });
        $('body').on('click','.delete_field',function(e){
            e.preventDefault();
            $(this).parents('.parameter_list').remove();
        });
        $('body').on('click','.delete_field_header',function(e){
            e.preventDefault();
            $(this).parents('.header_list').remove();
        });
        $(".box-response-data").css('display', 'none');
        $('.test-api').click(function(){
            var url_api = $(".url_api").val();
            var method_type = $(".method_type").val();
            var param_key = [];
            var param_value = [];
            var param_description = [];
            var param_type = [];
            var param_require = [];
            $('input[name^="description_parameter_key"]').each(function() {
                param_key.push($(this).val());
            });
            $('input[name^="description_parameter_value"]').each(function() {
                param_value.push($(this).val());
            });
            $('input[name^="description_parameter_description"]').each(function() {
                param_description.push($(this).val());
            });
            $('input[name^="description_parameter_data_type"]').each(function() {
                param_type.push($(this).val());
            });
            $('input[name^="description_parameter_required"]').each(function() {
                param_require.push($(this).val());
            });
            var data = {
                url_api: url_api,
                method_type: method_type,
                param_key: param_key,
                param_value: param_value,
                param_description: param_description,
                param_type: param_type,
                param_require: param_require,
            };
            console.log(url_api, method_type, param_key, param_value, param_description, param_type, param_require);
            $("#loadMe").modal({
              backdrop: "static", //remove ability to close modal with click
              keyboard: false, //remove option to close with keyboard
              show: true //Display loader!
            });
            $.ajax({
                type: "POST",
                url: "{{route('test-api')}}",
                data: data,
                success:function(response){
                    $("#loadMe").modal("hide");
                    $(".box-response-data").css('display', 'block');
                    var info = JSON.stringify(response.data,null,"\t");
                    $(".data-response").html('');
                    $(".data-response").append('<pre>'+info+'</pre>');
                },
            });
        });
    </script>
@endsection