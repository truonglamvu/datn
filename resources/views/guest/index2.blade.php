@extends('layouts.layout_guest')

@section('content')
     <div id="documenter_content" class="method-area-wrapper">
        @foreach($menus as $key => $menu) 
            @foreach(Auth::user()->roles()->get() as $ur)
                @if(in_array($ur->name, $menu->visible_on))
                    @foreach($menu->posts as $postDetail)
                    
                        <section id="documenter-{{ $menu->id }}-{{ $postDetail->id }}" class="method">
                           <div class="method-area">
                              <div class="method-copy">
                                 <div class="method-copy-padding">
                                    <div class="api-name row">
                                      <div class="col-lg-8">
                                        <h5 class="api-method-{{ strtolower($postDetail->getMethod()) }}"><span>
                                        {{ $postDetail->getMethod() }}</span> {{ $postDetail->title }}
                                        </h5>
                                      </div>
                                      <div class="col-lg-4">
                                        <form style="float: right;margin-top: 10px;" action="{{route('runApi',$postDetail->id)}}">
                                          <button class="btn btn-primary">Run test</button>
                                        </form>
                                      </div>
                                    </div>
                                    <div class="content">
                                        <h5>Content: </h5>
                                        <blockquote>{!! $postDetail->content !!}</blockquote>
                                    </div>
                                    <div class="url">
                                        <h5>Endpoint: <code>{{ $postDetail->url }}</code></h5>
                                    </div>
                                    <h5>Parameters:</h5>
                                    <div class="table-responsive">
                                       <table class="table table-bordered table-exampled">
                                          <colgroup>
                                             <col class="col-xs-3">
                                             <col class="col-xs-3">
                                             <col class="col-xs-4">
                                             <col class="col-xs-2">
                                          </colgroup>
                                          <thead>
                                             <tr>
                                                <th>Key</th>
                                                <th>Value</th>
                                                <th>Description</th>
                                                <th>Data Type</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($postDetail->getParamater() as $param)
                                                 
                                                 <tr>
                                                    <th>
                                                       <code>{{ $param['key'] }} </code>
                                                    @if(isset($param['required']) && $param['required'] == "required")
                                                       <sup class="required-param"> (*)</sup>
                                                    @endif
                                                    </th>
                                                    <th>
                                                       <code>{{ $param['value'] }} </code>
                                                    </th>
                                                    <th>
                                                       {{ $param['description'] }}
                                                    </th>
                                                    @if(isset($param['data_type']))
                                                    <th>
                                                      <code> {{ $param['data_type'] }} </code>
                                                    </th>
                                                    @else
                                                    <th>
                                                      <i>NULL</i>
                                                    </th>
                                                    @endif
                                                 </tr>
                                                 
                                            @endforeach
                                          </tbody>
                                       </table>
                                       @if(isset($param['required']))
                                        (*) is required.
                                       @endif
                                    </div>
                                    @if(isset($postDetail->header) && !empty($postDetail->header))
                                        <div class="header-api">
                                            <h5>Headers</h5>
                                            <hr>
                                            <div class="table-responsive">
                                              <table class="table table-bordered table-exampled">
                                                <colgroup>
                                                 <col class="col-xs-3">
                                                 <col class="col-xs-9">
                                                </colgroup>
                                                <thead>
                                                 <tr>
                                                    <th>Header code</th>
                                                    <th>Description</th>
                                                 </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($postDetail->getHeader() as $header)
                                                    <tr>
                                                      <th>{{ $header['header_key'] }}</th>
                                                      <td>{{ $header['header_value'] }}</td>
                                                    </tr>
                                                  @endforeach
                                                </tbody>
                                              </table>
                                            </div>
                                            <hr>
                                        </div>
                                    @endif
                                    @if($postDetail->error != null)
                                        <h5>Errors</h5>
                                         <div class="table-responsive">
                                           <table class="table table-bordered table-exampled">
                                              <colgroup>
                                                 <col class="col-xs-3">
                                                 <col class="col-xs-9">
                                              </colgroup>
                                              <thead>
                                                 <tr>
                                                    <th>Error code</th>
                                                    <th>Description</th>
                                                 </tr>
                                              </thead>
                                              <tbody>
                                                @foreach($postDetail->getError() as $error)
                                                    @if($error['error_code'] != null && $error['description'] != null)
                                                     <tr>
                                                        <th>
                                                          {{ $error['error_code'] }}
                                                        </th>
                                                        <th>
                                                          {{ $error['description'] }}
                                                        </th>
                                                     </tr>
                                                    @endif
                                                @endforeach
                                              </tbody>
                                           </table>
                                        </div>
                                     @endif
                                     <i>Người viết: </i><span>{{ $postDetail->user->name }}</span>
                                 </div>
                              </div>
                              <div class="method-example">
                                 <div class="method-example-part">
                                    <p>Sample Response</p>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <a class="btn-show-content" title="click to expand" data-toggle="modal" data-target="#myModal"><pre class="data-return">{{ $postDetail->data_return }}</pre></a>

                                                <!-- Modal -->
                                            </tr>
                                        </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </section>
                    @endforeach
                @endif
            @endforeach
        @endforeach
     </div>

     <div id="myModal" class="modal fade" role="dialog" aria-hidden='true'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <pre class="detail-data-return"></pre>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-footer')
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
        $(document).ready(function(){
           $('.hidden-menu').hide();
           $('.dropdown-toggle').click(function(){
              $('.hidden-menu').toggle();
           });

            // show content modal data return
            $('.btn-show-content').on('click', function(){
                var content = $(this).find('pre.data-return').text();
                $('#myModal').find('.modal-body pre').html(content);
                $('#myModal').find('.modal-dialog').css('opacity',0.85);
            });
        });
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
                       $('#preview-post').append('<div class="preview" style="border-bottom:1px solid #ccc;"><a href = "#documenter-'+value.menu_id+'-'+value.id+'"><i>'+value.title+'</i></a></div>');
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