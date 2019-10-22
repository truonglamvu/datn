@extends('layouts.layout')
@section('content')
    <h1 align="center" style="border-bottom: 1px solid #ccc; padding-bottom:15px;">Bài viết</h1>
    <section id="documenter-1" class="method">
      <div class="row" style="border-left:1px solid #4cae4c">
        <div class="col-sm-2"></div>
        <div class="col-sm-6" style="margin-bottom:20px;margin-top:10px;">
            <input type="text" name="searchDoc" id="searchDoc" class="form-control" style="width: 575px;" placeholder="Enter title, content..." onkeyup="searchPost()">
            <div id="preview-post" style="border:1px solid #ccc;width: 575px;padding-left: 15px;margin-top:5px;border-radius: 5px;">
                
            </div>
        </div>
        <div class="col-sm-1" style="margin-bottom:20px;margin-top:10px;">
            <button class="form-control" style="width: 50px;"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="col-sm-3" style="text-align:right;margin-bottom:20px;margin-top:10px;">
            <a href="{{ route('document.create') }}" class="btn btn-primary" style="color:white;">Tạo mới document</a>
        </div>
         @foreach ($posts as $post)
            @if($post->method == "GET")
                <div class="col-sm-12 active" style="margin-top: 20px;margin-bottom: 10px; border:1px solid #61affe; padding-bottom: 10px;padding-top: 10px;width:97%;margin-left: 15px;border-radius:10px;" >
                   <a href="" class="btn btn-primary" style="color: white; width: 80px;">{{ $post->method }} </a><span style="font-size: 15px;margin-top: 20px;"> <a href="{{ route('document.show',$post->id) }}"><span style="color: black;font-size:16px;">{{ $post->title }}</span></a></span>
                   @if(Auth::id() == $post->user_id)
                       <span style="float: right; margin-left: 10px;">
                            <form action="{{ route('document.destroy',$post->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này khỏi danh sách?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                       </span>
                       <span style="float: right;"><a style="color:white;" href="{{ route('document.edit',$post->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></span>
                   @endif
                </div>
            @endif
            @if($post->method == "POST")
                <div class="col-sm-12 active" style="margin-top: 20px;margin-bottom: 10px; border:1px solid #4cae4c; padding-bottom: 10px;padding-top: 10px;width:97%;margin-left: 15px;border-radius:10px;" >
               <a href="" class="btn btn-success" style="color: white; width: 80px;">{{ $post->method }} </a><span style="font-size: 15px;margin-top: 20px;"> <a href="{{ route('document.show',$post->id) }}"><span style="color: black;font-size:16px;">{{ $post->title }}</span></a></span>
                   @if(Auth::id() == $post->user_id)
                       <span style="float: right; margin-left: 10px;">
                            <form action="{{ route('document.destroy',$post->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này khỏi danh sách?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                       </span>
                       <span style="float: right;"><a style="color:white;" href="{{ route('document.edit',$post->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></span>
                   @endif
                </div>
            @endif
            @if($post->method == "PUT" || $post->method == "PATCH")
                <div class="col-sm-12 active" style="margin-top: 20px;margin-bottom: 10px; border:1px solid #d58512; padding-bottom: 10px;padding-top: 10px;width:97%;margin-left: 15px;border-radius:10px;" >
               <a href="" class="btn btn-warning" style="color: white; width: 80px;">{{ $post->method }} </a><span style="font-size: 15px;margin-top: 20px;"> <a href="{{ route('document.show',$post->id) }}"><span style="color: black;font-size:16px;">{{ $post->title }}</span></a></span>
                   @if(Auth::id() == $post->user_id)
                       <span style="float: right; margin-left: 10px;">
                            <form action="{{ route('document.destroy',$post->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này khỏi danh sách?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                       </span>
                       <span style="float: right;"><a style="color:white;" href="{{ route('document.edit',$post->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></span>
                   @endif
                </div>    
            @endif
            @if($post->method == "DELETE")
                <div class="col-sm-12 active" style="margin-top: 20px;margin-bottom: 10px; border:1px solid #d43f3a; padding-bottom: 10px;padding-top: 10px;width:97%;margin-left: 15px;border-radius:10px;" >
               <a href="" class="btn btn-danger" style="color: white; width: 80px;">{{ $post->method }} </a><span style="font-size: 15px;margin-top: 20px;"> <a href="{{ route('document.show',$post->id) }}"><span style="color: black;font-size:16px;">{{ $post->title }}</span></a></span>
                   @if(Auth::id() == $post->user_id)
                       <span style="float: right; margin-left: 10px;">
                            <form action="{{ route('document.destroy',$post->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này khỏi danh sách?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                       </span>
                       <span style="float: right;"><a style="color:white;" href="{{ route('document.edit',$post->id) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></span>
                   @endif
                </div>
            @endif
         @endforeach
      </div>
   </section>
   <script type="text/javascript">
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
        $("#preview-post").hide();
       function searchPost(){
            $(document).ready(function(){

                var searchDoc = $("#searchDoc").val();

                $.ajax({
                    type: 'GET',
                    url : '{{URL::to('document-suggest')}}',
                    data: {'searchDoc': searchDoc},
                    success:function(data){
                    $('#preview-post').html("");
                    $.each(data,function(index, value){
                       $('#preview-post').css('display','block');
                       $('#preview-post').append('<div class="preview" style="border-bottom:1px solid #ccc;">'+value.title+' <a href = "/document/'+value.id+'"><i>[Đến xem]</i></a></div>');
                    })
                    if ($('#searchDoc').val() == "") {
                       $('#preview-post').html("");
                       $('#preview-post').css('display','none');
                    }
                 }
              })
            })
       }
   </script>
@endsection 