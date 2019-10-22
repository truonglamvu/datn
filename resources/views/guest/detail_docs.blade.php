@extends('layouts.layout')

@section('content')
	<section id="documenter-1" class="method">
       <div class="row" style="border:1px solid #4cae4c;border-left:1px solid #4cae4c">
          <div class="col-sm-12 active" style="margin-top: 10px;border-bottom: 1px solid #ccc; padding-bottom:10px;" >
             <select class="btn btn-info">
                <option class="btn btn-info" selected>{{ $post->method }}</option>
                <option class="btn btn-success">POST</option>
                <option class="btn btn-warning">PUT</option>
                <option class="btn btn-warning">PATCH</option>
                <option class="btn btn-danger">DELETE</option>
             </select> <span style="font-size: 18px;"> {{ $post->title }}</span> 
             <span style="float: right;"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
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
                   <td><strong>Data return <span style="color: red;">(*)</span></strong></td>
                   <td align="left">
                      <div>
                         <p><strong>Value</strong></p>
                         <!-- <pre style="background-color: #ccc;color: black;padding: 10px;white-space: pre-wrap;word-break: break-word;border-radius: 4px;overflow-wrap: break-word;font-weight: 600">
                            <span>{</span>
                            <span>"id": 0,</span>
                            <span>"username": "string",</span>
                            <span>"firstname": "string",</span>
                            <span>"lastname": "string",</span>
                            <span>"email": "string",</span>
                            <span>"password": "string",</span>
                            <span>"phone": "string",</span>
                            <span>"userstatus": 0,</span>
                            <span>}</span>
                         </pre> -->
                         <table>
                            <thead>
                               <tr>
                                  <th>Name</th>
                                  <th>type</th>
                                  <th>description</th>
                                  <th>value</th>
                                  <th>require</th>
                               </tr>
                            </thead>
                            <tbody>
                               <tr>
                                  <td>id</td>
                                  <td>integer</td>
                                  <td>Mã người dùng</td>
                                  <td>0</td>
                                  <td>
                                     <select>
                                        <option>Có</option>
                                        <option>Không</option>
                                     </select>
                                  </td>
                               </tr>
                               <tr>
                                  <td>username</td>
                                  <td>string</td>
                                  <td>Tên đăng nhập</td>
                                  <td>truonglamvu</td>
                                  <td>
                                     <select>
                                        <option>Có</option>
                                        <option>Không</option>
                                     </select>
                                  </td>
                               </tr>
                               <tr>
                                  <td>firstname</td>
                                  <td>string</td>
                                  <td>Họ của người dùng</td>
                                  <td>Trương</td>
                                  <td>
                                     <select>
                                        <option>Có</option>
                                        <option>Không</option>
                                     </select>
                                  </td>
                               </tr>
                               <tr>
                                  <td>lastname</td>
                                  <td>string</td>
                                  <td>Tên người dùng</td>
                                  <td>Lâm Vũ</td>
                                  <td>
                                     <select>
                                        <option>Có</option>
                                        <option>Không</option>
                                     </select>
                                  </td>
                               </tr>
                               <tr>
                                  <td>email</td>
                                  <td>string</td>
                                  <td>Email người dùng</td>
                                  <td>vutl.hust@gmail.com</td>
                                  <td>
                                     <select>
                                        <option>Có</option>
                                        <option>Không</option>
                                     </select>
                                  </td>
                               </tr>
                               <tr>
                                  <td>password</td>
                                  <td>string</td>
                                  <td>Mật khẩu người dùng</td>
                                  <td>0</td>
                                  <td>
                                     <select>
                                        <option>Có</option>
                                        <option>Không</option>
                                     </select>
                                  </td>
                               </tr>
                               <tr>
                                  <td>phone</td>
                                  <td>integer</td>
                                  <td>Số điện thoại người dùng</td>
                                  <td>0</td>
                                  <td>
                                     <select>
                                        <option>Có</option>
                                        <option>Không</option>
                                     </select>
                                  </td>
                               </tr>
                               <tr>
                                  <td>userstatus</td>
                                  <td>integer</td>
                                  <td>Trạng thái tài khoản</td>
                                  <td>0</td>
                                  <td>
                                     <select>
                                        <option>Có</option>
                                        <option>Không</option>
                                     </select>
                                  </td>
                               </tr>
                            </tbody>
                         </table>
                      </div>
                   </td>
                </tr>
                <tr>
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
                </tr>
             </table>
             <i style="float:right;">Người viết: <a id="list-user-document" href="{{ route('listDocumentForUser',$post->user->id) }}" style="color:black;">{{ $post->user->name }}</a></i>
          </div>
       </div>
    </section>
@endsection