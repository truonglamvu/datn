@extends('layouts.layout_admin')

@section('content')
	<section id="documenter-1" class="method">
       <div class="row">
            <div class="col-sm-12 active method-name">
                <span class="text-method-{{ strtolower($post->method) }}"><a href="">{{ $post->method }}</a></span>
                <span class="text-title">{{ $post->title }}</span> 
            </div>
            <div class="col-sm-12 description-api">
                <span style="font-size:16px;"><strong>Description: </strong> {{ $post->content }}</span>
            </div>
            <div class="col-sm-12 content-docs">
            <div class="col-sm-12 content url-name">
                <span>URL:</span>
                <span><code>{{ $post->url }}</code></span>
            </div>
            <div class="col-sm-12 content">
                <table class="table table-hover">
                    <thead>
                       <tr>
                          <th colspan="4"><h4 align="center">Parameters</h4></th>
                       </tr>
                       <tr>
                          <th>Key</th>
                          <th>Value</th>
                          <th>Description</th>
                       </tr>
                    </thead>
                    <tbody>
                    	@foreach($post->description_parameter as $param)
                       		<tr>
    	                        <td><code><input type="text" name="description_parameter_key[]" class="parameter" value="{{ $param['key'] }}" disabled></code></td>
    	                        <td><input type="text" name="description_parameter_value[]" class="parameter" value="{{ $param['value'] }}" disabled></td>
    	                        <td><input type="text" name="description_parameter_description[]" class="parameter" value="{{ $param['description'] }}" disabled></td>
                       		</tr>
                        @endforeach
                    </tbody>    
                </table>
            </div>
            <hr>
            @if($post->header != null)
                <div class="col-sm-12 content">
                    <table class="table table-hover">
                        <thead>
                           <tr>
                              <th colspan="3"><h4 align="center">Header</h4></th>
                           </tr>
                           <tr>
                              <th>Key</th>
                              <th>Value</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach($post->header as $header)
                                <tr>
                                    <td><code><input type="text" name="header_key[]" class="parameter" value="{{ $header['header_key'] }}" disabled></code></td>
                                    <td><input type="text" name="header_value[]" class="parameter" value="{{ $header['header_value'] }}" disabled></td>
                                </tr>
                            @endforeach
                        </tbody>    
                    </table>
                </div>
            @endif
            <div class="col-sm-12 content">
                <table class="table table-hover" cellspacing="10px" cellpadding="10px">
                    <tr>
                        <td width="100px"><strong>Sample response <span style="color: red;">(*)</span></strong></td>
                        <td align="left">
                            <div>
                                <p><strong>Value</strong></p>
                                <table>
                                    <tbody> 
                                        <tr>
                                            <pre><code>{{ $post->data_return }}</code></pre>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            @if($post->error != null)
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                           <tr>
                              <th colspan="4" align="center"><h4>Errors</h4></th>
                           </tr>
                           <tr>
                              <th>Error</th>
                              <th>Description</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach($post->error as $error)
                                <tr>
                                    <td><code><input type="text" name="error[0][error_code]" class="parameter" value="{{ $error['error_code'] }}" disabled></code></td>
                                    <td><input type="text" name="error[0][description]" class="description-error" value="{{ $error['description'] }}" disabled></td>
                                </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <i style="float:right;">Người viết: <a id="list-user-document" href="#" style="color:black;">{{ $post->user->name }}</a></i>
        </div>
    </section>
@endsection