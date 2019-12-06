<?php

namespace App\Http\Controllers;

use App\Repository\Users\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repository\Post\PostRepository;
use App\Repository\Post\PostModel;
use App\Repository\Permission\PermissionModel;
use App\Repository\Role\RoleModel;
use App\Repository\Menus\MenusRepository;
use App\Repository\Menus\MenusModel;
use App\Repository\Users\UsersModel;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\User;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
class PostController extends Controller
{
    
    public function index(Request $request, PostModel $postModel, MenusRepository $menuRepository,UsersRepository $userRepository)
    {
        if(Auth::user()->can('view-docs'))
        {
            $keyword = $request->search;
            $posts = $postModel->with('user');
            if (!empty($keyword)) $posts = $posts->where(function ($query) use ($keyword) {
                $query->orWhere('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('url', 'LIKE', '%' . $keyword . '%');
            });
            if (!empty($request->user_id)) $posts = $posts->where('user_id', '=', $request->user_id);
            if (!empty($request->menu_id)) $posts = $posts->where('menu_id', '=', $request->menu_id);
            $limit = 10;
            if (!empty($request->limit)) $limit = $request->limit;
            $posts = $posts->orderBy('created_at','desc')->paginate($limit);
            foreach ($posts as $post) {
                switch ($post->method) {
                    case '1':
                        $post->method = "GET";
                        break;
                    case '2':
                        $post->method = "POST";
                        break;
                    case '3':
                        $post->method = "PUT";
                        break;
                    case '4':
                        $post->method = "PATCH";
                        break;
                    case '5':
                        $post->method = "DELETE";
                        break;
                }
            }
//            dd($post->toArray());
            $menus = $menuRepository->getAll();
            $users = $userRepository->getAll();
            $params_search = '?search=' . $keyword;
            if (!empty($request->user_id)) $params_search .= '&user_id=' . $request->user_id;
            if (!empty($request->menu_id)) $params_search .= '&menu_id=' . $request->menu_id;
            if ($limit != 10) $params_search .= '&limit=' . $limit;
            $posts->withPath('/admin/document' . $params_search);
            return view('admin.document.docs_api',compact('posts','menus', 'users'));
        }
        return view('error.404');
        
    }

    public function create(MenusRepository $menuRepository)
    {   
        $menus = $menuRepository->getAll();

        $dataType = [
            'String',
            'Json',
            'Number',
            'Boolean',
            'Array',
        ];

        if(Auth::user()->can('create-post')){
            return view('admin.document.create_document',compact('menus', 'dataType'));
        }
        return view('error.404');
    }

    
    public function store(PostRequest $request, PostRepository $postRepository)
    {
        $params = $request->all();
        
        $post = $postRepository->createPost($params);
        $notification = array(
            'message'       =>  'Bạn đã tạo mới 1 bài viết!',
            'alert-type'    =>  'success',
        );
        
        return redirect()->route('document.index')->with($notification);
    }

    public function show($id, PostRepository $postRepository)
    {
        if(Auth::user()->can('view-detail-document'))
        {
            $post = $postRepository->find($id);
            $post->description_parameter = unserialize($post->description_parameter);
            $post->error = unserialize($post->error);
            $post->header = unserialize($post->header);
            $post->data_return = $this->prettyPrint($post->data_return);

            switch ($post->method) {
                case '1':
                    $post->method = "GET";
                    break;
                case '2':
                    $post->method = "POST";
                    break;
                case '3':
                    $post->method = "PUT";
                    break;
                case '4':
                    $post->method = "PATCH";
                    break;
                case '5':
                    $post->method = "DELETE";
                    break;
            }
            return view('admin.document.detail_docs',compact(['post','detail_doc']));
        }
        return view('error.404');
    }

    public function edit(PostRepository $post, $id, MenusRepository $menuRepository)
    {
        $dataType = [
            'String',
            'Json',
            'Number',
            'Boolean',
            'Array'
        ];

        if(Auth::user()->can('edit-document'))
        {
            $doc = $post->find($id);
            $menu = $menuRepository->find($doc->menu_id);
            $menuLists = $menuRepository->getAll();
            $doc->error = unserialize($doc->error);
            $doc->header = unserialize($doc->header);
            $doc->description_parameter = unserialize($doc->description_parameter);
            return view('admin.document.edit_document',compact(['doc','menu','menuLists', 'dataType'])); 
        }
        return view('error.404');
    }

    public function update(PostRequest $request, $id, PostRepository $postRepository)
    {
        $params = $request->all();
        $post = $postRepository->updatePost($params,$id);
        $notification = array(
            'message'       =>  'Bạn đã cập nhật 1 bài viết!',
            'alert-type'    =>  'success',
        );
        return redirect()->route('document.index')->with($notification);
    }

    public function destroy(PostRepository $post, $id)
    {
        $posts = $post->delete($id);
        return response()->json([
            'msg'   =>  'Post deleted',
            'status'    =>  'Success'
        ]);
    }

    public function active(PostRepository $postRepository,$id){
        if(Auth::user()->can('active-document'))
        {
            $post = $postRepository->find($id);
            if ($post->active == 0) {
                $post->active = 1;
            }else{
                $post->active = 0;
            }
            $notification = array(
                'message'       =>  'Bạn đã active 1 bài viết!',
                'alert-type'    =>  'success',
            );
            return response()->json([
                'success' => $post->save(),
                'value' =>  $post->active,
            ]);
        }
        return view('error.404');
    }

    public function search(Request $request, PostModel $postModel){
        $output = [];
        $keyword = $request->search;
        $searchs = $postModel->with('user')->where(function ($query) use ($keyword) {
            $query->orWhere('title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('url', 'LIKE', '%' . $keyword . '%');
        });
        if (!empty($request->user_id)) $searchs = $searchs->where('user_id', '=', $request->user_id);
        if (!empty($request->menu_id)) $searchs = $searchs->where('menu_id', '=', $request->menu_id);
        $limit = 10;
        if (!empty($request->limit)) $limit = $request->limit;
        $searchs = $searchs->orderBy('created_at','desc')->paginate($limit);
        foreach ($searchs as $key => $searchTitle) {
           if ($searchTitle->active == 0) {
               $checked = "";
           }
           else{
            $checked = "checked";
           }
           switch ($searchTitle->method) {
                case '1':
                    $searchTitle->method = "GET";
                    break;
                case '2':
                    $searchTitle->method = "POST";
                    break;
                case '3':
                    $searchTitle->method = "PUT";
                    break;
                case '4':
                    $searchTitle->method = "PATCH";
                    break;
                case '5':
                    $searchTitle->method = "DELETE";
                    break;
            }
           $output[] = '<tr>'.
                       '<td>'.$searchTitle->id.'</td>'.
                       '<td>'.$searchTitle->title.'</td>'.
                       '<td style="max-width: 210px;word-wrap: break-word;">'.$searchTitle->url.'</td>'.
                       '<td>'.$searchTitle->method.'</td>'.
                       '<td>'.(!empty($searchTitle->user->name) ? $searchTitle->user->name : 'No name').'</td>'.
                       '<td>'
                       .'<a href = "/admin/document/'.$searchTitle->id.'" class="btn btn-info" style="margin: 0 5px"> '.'<i class="fa fa-eye" aria-hidden="true"></i> </a>'
                       .'<a href = "/admin/document/'.$searchTitle->id.'/edit" class="btn btn-warning" style="margin: 0 5px">'.'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>'
                       .'<form style="display:inline-block;margin: 0 5px" action="/admin/document/'.$searchTitle->id.'" method="POST" >'.'<input type="hidden" name="_token" value="a9mT94TgIWDc7c6o15XsJZs9tR0clQ34J9dJxM1I">'.'<input type="hidden" name="_method" value="DELETE">'.'<button type="submit" class="btn btn-danger" onclick="return confirm("Bạn có chắc muốn xóa bài viết này khỏi danh sách?")"><i class="fa fa-trash-o" aria-hidden="true"></i> </button></form>'
                       .'<span class="pretty p-icon p-smooth" style="font-size: 20px;"><input type="hidden" name="id" class="post_id" value="'.$searchTitle->id.'">'.'<input type="checkbox" name="status" class="change-status" data-post-id="'.$searchTitle->id.'" '.$checked.'><span class="state p-success"><i class="icon fa fa-check"></i><label></label></span></span></td>'
                       .'</tr>';
        }
        $posts = $searchs;
        $params_search = '?search=' . $keyword;
        if (!empty($request->user_id)) $params_search .= '&user_id=' . $request->user_id;
        if (!empty($request->menu_id)) $params_search .= '&menu_id=' . $request->menu_id;
        if ($limit != 10) $params_search .= '&limit=' . $limit;
        $posts->withPath('/admin/document' . $params_search);
        return view('admin.document.elements.list_api_docs', compact('posts'));
//        return response($output);
    }
    public function suggest(Request $request, PostModel $postModel){
        $output = [];
        $searchTitles = $postModel->where('title','like','%'.$request->searchDoc.'%')->where('active',1)->get();
            foreach($searchTitles as $searchTitle){
                $output[]= ['title'=>$searchTitle->title,'id'=>$searchTitle->id,'menu_id' => $searchTitle->menu_id];
            }
        return response()->json($output);
    }
    public function listDocument($id, PostModel $postModel){
        $user = User::find($id);
        $posts = $postModel->where('active',1)->where('user_id',$user->id)->paginate(8);
            foreach ($posts as $post) {
                switch ($post->method) {
                    case '1':
                        $post->method = "GET";
                        break;
                    case '2':
                        $post->method = "POST";
                        break;
                    case '3':
                        $post->method = "PUT";
                        break;
                    case '4':
                        $post->method = "PATCH";
                        break;
                    case '5':
                        $post->method = "DELETE";
                        break;
                }
            }
        return view('guest.list-user-document',compact(['posts','user']));   
        }
    public function searchInListUserDocument(Request $request, $id, PostModel $postModel){
        $output = [];
        $user = User::find($id);
        $searchTitles = $postModel->where('user_id',$user->id)->where('title','like','%'.$request->searchDoc.'%')->get();
            foreach($searchTitles as $searchTitle){
                $output[]= ['title'=>$searchTitle->title,'id'=>$searchTitle->id];
            }
        return response()->json($output);
    }
    public function backPage(){
        return redirect()->route('document.index');
    }

    public function documentByMenu(PostModel $postModel, $id){
        $posts = $postModel->where('menu_id', $id)->paginate(6);
        foreach ($posts as $post) {
                switch ($post->method) {
                    case '1':
                        $post->method = "GET";
                        break;
                    case '2':
                        $post->method = "POST";
                        break;
                    case '3':
                        $post->method = "PUT";
                        break;
                    case '4':
                        $post->method = "PATCH";
                        break;
                    case '5':
                        $post->method = "DELETE";
                        break;
                }
            }
        return view('guest.docs_by_menu',compact('posts')); 
    }

    public function dumplicateData(PostRepository $post, $id, MenusRepository $menuRepository){
        $dataType = [
            'String',
            'Json',
            'Number',
            'Boolean',
            'Array'
        ];

        if(Auth::user()->can('edit-document'))
        {
            $doc = $post->find($id);
            $menu = $menuRepository->find($doc->menu_id);
            $menuLists = $menuRepository->getAll();
            $doc->error = unserialize($doc->error);
            $doc->header = unserialize($doc->header);
            $doc->description_parameter = unserialize($doc->description_parameter);
            return view('admin.document.dumplicate_data_document',compact(['doc','menu','menuLists', 'dataType'])); 
        }
        return view('error.404');
    }

    public function filterDocumentByMenu(Request $request,PostModel $postModel){
        $output=[];
        $posts = $postModel->where('menu_id','=',$request->id_menu)->orderBy('created_at','desc')->paginate(10);
        foreach($posts as $key => $post){
            if ($post->active == 0) {
                    $checked = "";
                }
                else{
                    $checked = "checked";
                }
               switch ($post->method) {
                    case '1':
                        $post->method = "GET";
                        break;
                    case '2':
                        $post->method = "POST";
                        break;
                    case '3':
                        $post->method = "PUT";
                        break;
                    case '4':
                        $post->method = "PATCH";
                        break;
                    case '5':
                        $post->method = "DELETE";
                        break;
                }
                $output[] = '<tr>'.
                           '<td>'.$post->id.'</td>'.
                           '<td>'.$post->title.'</td>'.
                           '<td>'.$post->content.'</td>'.
                           '<td>'.$post->method.'</td>'.
                           '<td>'.$post->user->name.'</td>'.
                           '<td>'.'<a href = "/document/'.$post->id.'" class="btn btn-info">'.'<i class="fa fa-eye" aria-hidden="true"></i> View</a></td>'.
                           '<td>'.'<a href = "/document/'.$post->id.'/edit" class="btn btn-warning">'.'<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></td>'.
                           '<td>'.'<form action = "/document/'.$post->id.'" method = "POST">'.'<input type="hidden" name="_token" value="a9mT94TgIWDc7c6o15XsJZs9tR0clQ34J9dJxM1I">'.'<input type="hidden" name="_method" value="DELETE">'.'<button type="submit" class="btn btn-danger" onclick="return confirm("Bạn có chắc muốn xóa bài viết này khỏi danh sách?")"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>'.
                            '<td>'.'<div class="pretty p-icon p-smooth" style="margin-top:3px;font-size: 20px;"><input type="hidden" name="id" class="post_id" value="'.$post->id.'">'.'<input type="checkbox" name="status" class="change-status" data-post-id="'.$post->id.'" '.$checked.'><div class="state p-success"><i class="icon fa fa-check"></i><label></label></div></div>'.
                           '</tr>';
        }
        return response()->json($output);
    }

    public function runApi(PostRepository $post, MenusRepository $menuRepository)
    {
         $dataType = [
            'String',
            'Json',
            'Number',
            'Boolean',
            'Array'
        ];

        if(Auth::user()->can('edit-document'))
        {
            $menus = $menuRepository->getAll();
            return view('guest.test_api',compact(['dataType', 'menus'])); 
        }
        return view('error.404');
    }
    public function testApi(Request $request){
        // API: + https://api.edumall.vn/api/courses/all/basic method: GET
        //      + https://jsonplaceholder.typicode.com/posts
        //      + https://jsonplaceholder.typicode.com/posts?id=2&userID=1
        $client = new \GuzzleHttp\Client();
        $params_api = [];
        if (count($request['param_key']) > 0 && count($request['param_value'])) {
            foreach ($request['param_key'] as $key => $field) {
                foreach ($request['param_value'] as $key1 => $value) {
                    if ($key == $key1) {
                        $params_api[$field] = $value;
                    }
                }
            }
        }
        $type_method = '';
        if ($request['method_type'] == "GET") {
            $type_method = 'query';
        } else if($request['method_type'] == "POST") {
            $type_method = 'form_params';
        }
        try {
            $result = $client->request($request['method_type'], $request['url_api'],
                [
                    $type_method => $params_api
                    
                ]
            );
            $body = json_decode($result->getBody(), true);
            return response()->json([
                'data' => $body
            ]);
        } catch(ClientErrorResponseException $exception){
            $responseBody = $exception->getResponse()->getBody(true);
        }
    }

    public function prettyPrint( $json )
    {
        $result = '';
        $level = 0;
        $in_quotes = false;
        $in_escape = false;
        $ends_line_level = NULL;
        $json_length = strlen( $json );

        for( $i = 0; $i < $json_length; $i++ ) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if( $ends_line_level !== NULL ) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if ( $in_escape ) {
                $in_escape = false;
            } else if( $char === '"' ) {
                $in_quotes = !$in_quotes;
            } else if( ! $in_quotes ) {
                switch( $char ) {
                    case '}': case ']':
                        $level--;
                        $ends_line_level = NULL;
                        $new_line_level = $level;
                        break;

                    case '{': case '[':
                        $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;

                    case ':':
                        $post = " ";
                        break;

                    case " ": case "\t": case "\n": case "\r":
                        $char = "";
                        $ends_line_level = $new_line_level;
                        $new_line_level = NULL;
                        break;
                }
            } else if ( $char === '\\' ) {
                $in_escape = true;
            }
            if( $new_line_level !== NULL ) {
                $result .= "\n".str_repeat( "\t", $new_line_level );
            }
            $result .= $char.$post;
        }

        return $result;
    }

    public function dashboard(UsersModel $userModel, MenusModel $menusModel, RoleModel $roleModel, PostModel $postModel, PermissionModel $permissionModel)
    {
        $user = $userModel->orderBy('created_at', 'desc')->get();
        $menu = $menusModel->get()->count();
        $role = $roleModel->get()->count();
        $post = $postModel->get()->count();
        $time_create_new_user = $userModel->select('created_at')->orderBy('created_at','desc')->first();
        $time_create_new_menu = $menusModel->select('created_at')->orderBy('created_at','desc')->first();
        $time_create_new_role = $roleModel->select('created_at')->orderBy('created_at','desc')->first();
        $time_create_new_post = $postModel->select('created_at')->orderBy('created_at','desc')->first();
        $time_create_new_permission = $permissionModel->select('created_at')->orderBy('created_at','desc')->first();

        $now = Carbon::now();
        $user_count_chart = [];
        $post_count_chart = [];
        $menu_count_chart = [];
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');
        // count user in week
        $count_mon_user = $userModel->where('created_at', 'like', $weekStartDate.'%')->count();
        $count_tue_user = $userModel->where('created_at', 'like', $now->startOfWeek()->addDays(1)->format('Y-m-d').'%')->count();
        $count_wed_user = $userModel->where('created_at', 'like', $now->startOfWeek()->addDays(2)->format('Y-m-d').'%')->count();
        $count_thu_user = $userModel->where('created_at', 'like', $now->startOfWeek()->addDays(3)->format('Y-m-d').'%')->count();
        $count_fri_user = $userModel->where('created_at', 'like', $now->startOfWeek()->addDays(4)->format('Y-m-d').'%')->count();
        $count_sat_user = $userModel->where('created_at', 'like', $now->startOfWeek()->addDays(5)->format('Y-m-d').'%')->count();
        $count_sun_user = $userModel->where('created_at', 'like', $weekEndDate.'%')->count();
        // count post in week
        $count_mon_post = $postModel->where('created_at', 'like', $weekStartDate.'%')->count();
        $count_tue_post = $postModel->where('created_at', 'like', $now->startOfWeek()->addDays(1)->format('Y-m-d').'%')->count();
        $count_wed_post = $postModel->where('created_at', 'like', $now->startOfWeek()->addDays(2)->format('Y-m-d').'%')->count();
        $count_thu_post = $postModel->where('created_at', 'like', $now->startOfWeek()->addDays(3)->format('Y-m-d').'%')->count();
        $count_fri_post = $postModel->where('created_at', 'like', $now->startOfWeek()->addDays(4)->format('Y-m-d').'%')->count();
        $count_sat_post = $postModel->where('created_at', 'like', $now->startOfWeek()->addDays(5)->format('Y-m-d').'%')->count();
        $count_sun_post = $postModel->where('created_at', 'like', $weekEndDate.'%')->count();
        // count menu in week
        $count_mon_menu = $menusModel->where('created_at', 'like', $weekStartDate.'%')->count();
        $count_tue_menu = $menusModel->where('created_at', 'like', $now->startOfWeek()->addDays(1)->format('Y-m-d').'%')->count();
        $count_wed_menu = $menusModel->where('created_at', 'like', $now->startOfWeek()->addDays(2)->format('Y-m-d').'%')->count();
        $count_thu_menu = $menusModel->where('created_at', 'like', $now->startOfWeek()->addDays(3)->format('Y-m-d').'%')->count();
        $count_fri_menu = $menusModel->where('created_at', 'like', $now->startOfWeek()->addDays(4)->format('Y-m-d').'%')->count();
        $count_sat_menu = $menusModel->where('created_at', 'like', $now->startOfWeek()->addDays(5)->format('Y-m-d').'%')->count();
        $count_sun_menu = $menusModel->where('created_at', 'like', $weekEndDate.'%')->count();

        array_push($user_count_chart, $count_mon_user, $count_tue_user, $count_wed_user, $count_thu_user, $count_fri_user, $count_sat_user, $count_sun_user);
        array_push($post_count_chart, $count_mon_post, $count_tue_post, $count_wed_post, $count_thu_post, $count_fri_post, $count_sat_post, $count_sun_post);
        array_push($menu_count_chart, $count_mon_menu, $count_tue_menu, $count_wed_menu, $count_thu_menu, $count_fri_menu, $count_sat_menu, $count_sun_menu);
        $user_count_chart = json_encode($user_count_chart);
        $post_count_chart = json_encode($post_count_chart);
        $menu_count_chart = json_encode($menu_count_chart);
        return view('admin.dashboard', compact('user', 'menu', 'role', 'post', 'time_create_new_user', 'time_create_new_menu', 'time_create_new_role', 'time_create_new_post', 'time_create_new_permission', 'user_count_chart', 'post_count_chart', 'menu_count_chart'));
    }

    public function fetchDataCategories(UsersModel $userModel, MenusModel $menusModel, RoleModel $roleModel, PostModel $postModel, PermissionModel $permissionModel){
        $user = $userModel->get()->count();
        $menu = $menusModel->get()->count();
        $role = $roleModel->get()->count();
        $post = $postModel->get()->count();
        $permission = $permissionModel->get()->count();
        return response()->json([
            'number_of_user' => $user,
            'number_of_menu' => $menu,
            'number_of_role' => $role,
            'number_of_post' => $post,
            'number_of_permission' => $permission
        ]);
    }
}
