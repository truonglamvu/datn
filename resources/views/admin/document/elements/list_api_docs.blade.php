<div class="">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>URL</th>
            <th>Method</th>
            <th>Create By</th>
            <th style="min-width: 210px" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($posts))
            @foreach ($posts as $post)
                <tr class="document-data-{{ $post->id }}">
                    <td>{{ $post->id }}</td>
                    <td><a href="/#documenter-{{$post->menu_id}}-{{$post->id}}" target="_blank" title="{{ $post->title }}">{{ $post->title }}</a></td>
                    <td style="max-width: 300px;word-wrap: break-word;">{{ $post->url }}</td>
                    <td>{{ $post->method }}</td>
                    <td>{{ !empty($post->user->name) ? $post->user->name : 'No name' }}</td>
                    <td>

                        @if(Auth::id() == $post->user_id || Auth::user()->hasRole('super-admin'))
                            <a href="{{ route('document.edit',$post->id) }}" class="btn btn-warning" title="Edit" style="margin: 0 5px"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> </a>
                        @else
                            {{--                                        <a href="{{ route('document.edit',$post->id) }}" class="btn btn-warning" onclick="return false;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>--}}
                        @endif
                        <a href="{{ route('dumplicateData',$post->id) }}" target="_blank" class="btn btn-info" title="dumplicate data"><i class="fa fa-copy" aria-hidden="true"></i> </a>
                        <form method="POST" style="display: inline-block; margin: 0 5px">
                            {{ csrf_field() }}
                            {{ method_field('DELETE')}}
                            @if(Auth::id() == $post->user_id || Auth::user()->hasRole('super-admin'))
                                <button data-post-id="{{ $post->id }}" type="submit" class="btn btn-danger delete-post" title="Delete"><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> </button>
                            @else
                                {{--<button data-post-id="{{ $post->id }}" type="submit" class="btn btn-danger delete-post" disabled><i class="fa fa-trash-o" aria-hidden="true" ></i> Delete</button>--}}
                            @endif
                        </form>
                        @if($post->active == 0)

                            <span class="pretty p-icon p-smooth" style="margin:0 5px;font-size: 20px;">
                                        <input type="checkbox" name="status" class="change-status status-{{ $post->id}}" data-post-id="{{ $post->id }}" value="0">
                                        <div class="state">
                                            <i class="icon fa"></i>
                                            <label></label>
                                        </div>
                                    </span>
                        @else
                            <span class="pretty p-icon p-smooth" style="margin:0 5px;font-size: 20px;">
                                            <input type="checkbox" name="status" class="change-status status-{{ $post->id}} custom-checkbox" data-post-id="{{ $post->id }}" value="1" checked>
                                            <div class="state p-success">
                                                <i class="icon fa fa-check"></i>
                                                <label></label>
                                            </div>
                                        </span>
                        @endif
                        <input type="hidden" name="id" class="post_id" value="{{ $post->id }}">
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="">
    @if(!empty($posts))
        {{$posts->links()}}
    <div class="pagination pull-right">
        <select class="form-control" id="limit_record" onchange="searchDocs()">
            <option value="10" {{(Request::get('limit') == 10) ? 'selected' : ''}}>10</option>
            <option value="20" {{(Request::get('limit') == 20) ? 'selected' : ''}}>20</option>
            <option value="50" {{(Request::get('limit') == 50) ? 'selected' : ''}}>50</option>
        </select>
    </div>
    @endif
</div>