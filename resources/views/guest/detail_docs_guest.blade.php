@extends('layouts.layout')

@section('content')
	<section id="documenter-1" class="method">
       <div class="row">
          <div class="col-sm-12 active" style="margin-top: 10px;border-bottom: 1px solid #ccc; padding-bottom:10px;" >
            @if($post->method == "GET")
                <a href="" class="btn btn-primary" style="width: 90px; color:white;">{{ $post->method }}</a>
            @endif
            @if($post->method == "POST")
                <a href="" class="btn btn-success" style="width: 90px; color:white;">{{ $post->method }}</a>
            @endif
            @if($post->method == "PUT" || $post->method == "PATCH")
                <a href="" class="btn btn-warning" style="width: 90px; color:white;">{{ $post->method }}</a>
            @endif
            @if($post->method == "DELETE")
                <a href="" class="btn btn-danger" style="width: 90px; color:white;">{{ $post->method }}</a>
            @endif
             <span style="font-size:18px; margin-left:10px;">{{ $post->title }}</span>
          </div>
          <div class="col-sm-12" style="margin-top: 10px;border-bottom: 1px solid #ccc; padding-bottom:10px;">
             <span style="font-size:16px;"><strong>Description: </strong> {{ $post->content }}</span>
          </div>
          <div class="col-sm-12" style="margin-top: 10px; margin-bottom: 10px;border-top: 1px solid white;">
          <div class="col-sm-12 content" style="margin-top: 10px;margin-bottom: 10px;">
             <span>URL:</span>
             <form action="#" method="POST" style="display: inline-block;">
                <input type="text" name="" style="width: 900px;margin-left: 10px;background-color:white;border:none;" value="{{ $post->url }}" disabled>
             </form>
             
          </div>
          <div class="col-sm-12 content">
             <table class="table table-hover">
                <thead>
                   <tr>
                      <th colspan="4" align="center"><h4 style="text-align: center;">Parameters</h4></th>
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
	                        <td><input type="text" name="description_parameter[0][key]" style="width: 100%;height: 34px;border:none; background-color:white;" value="{{ $param['key'] }}" disabled></td>
	                        <td><input type="text" name="description_parameter[0][value]" style="width: 100%;height: 34px;border:none; background-color:white;" value="{{ $param['value'] }}" disabled></td>
	                        <td><input type="text" name="description_parameter[0][description]" style="width: 100%;height: 34px;border:none; background-color:white;" value="{{ $param['description'] }}" disabled></td>
                   		</tr>
                   @endforeach
                </tbody>
             </table>
          </div>
          <div class="col-sm-12 content">
             <table class="table table-hover" cellspacing="10px" cellpadding="10px">
                <tr>
                   <td width="100px"><strong>Data return <span style="color: red;">(*)</span></strong></td>
                   <td align="left">
                      <div>
                         <table>
                            <tbody>
                               
                            <tr>
                                <pre style="margin-left:20px;">{{ $post->data_return }}</pre>
                            </tr>
                            {{-- <tr>
                               <td><strong>Error</strong></td>
                               <td><strong>Description</strong></td>
                            </tr>
                            <tr>
                               <td style="font-size: 20px;">404</td>
                               <td style="background-color: #d9534f; color: white;padding-top:10px;">user not found</td>
                            </tr>
                            <tr>
                               <td style="font-size: 20px;">400</td>
                               <td style="background-color: #d9534f; color: white;">Invalid ID</td>
                            </tr>
                            <tr>
                               <td style="font-size: 20px;">405</td>
                               <td style="background-color: #d9534f; color: white;">Validation exception</td>
                            </tr> --}}
                            </tbody>
                        </table>
                    </table>
             <i style="float:right;">Người viết: <a id="list-user-document" href="{{ route('listDocumentForUser',$post->user->id) }}" style="color:black;">{{ $post->user->name }}</a></i>
          </div>
       </div>
    </section>
@endsection