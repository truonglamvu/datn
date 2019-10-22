<?php namespace App\Repository\Post;

use App\Repository\Repository;
use App\Repository\Post\PostModel;

class PostRepository extends Repository implements PostInterface
{
	// public function __construct(PostModel $postModel)
	// {
	// 	$this->postModel = $postModel;
	// }
	/**
     * get model
     * @return  string
     */
    public function model()
    {
        return "App\Repository\Post\PostModel";
    }


    public function createPost(Array $params)
    {
        if(count($params['description_parameter_value'])){
            foreach ($params['description_parameter_value'] as $key => $value) {
                $params['description_parameter'][$key]['key'] = $params['description_parameter_key'][$key];
                $params['description_parameter'][$key]['value'] = $params['description_parameter_value'][$key];
                $params['description_parameter'][$key]['description'] = $params['description_parameter_description'][$key];
                $params['description_parameter'][$key]['data_type'] = $params['description_parameter_data_type'][$key];
                $params['description_parameter'][$key]['required'] = $params['description_parameter_required'][$key];
            }
        }

        if(count($params['error_code'])){
            foreach ($params['error_code'] as $key => $value) {
                $params['error'][$key]['error_code']  = $params['error_code'][$key];
                $params['error'][$key]['description'] = $params['error_description'][$key];
            }
        }
        if(count($params['header_key'])){
            foreach ($params['header_key'] as $key => $value) {
                $params['header'][$key]['header_key']  = $params['header_key'][$key];
                $params['header'][$key]['header_value'] = $params['header_value'][$key];
            }
        }
    	$post = $this->_model->create([
            'title' =>  $params['title'],
            'content'   =>  $params['content'],
            'url'   =>  $params['url'],
            'description_parameter' =>  serialize($params['description_parameter']),
            'data_return'   =>  $params['data_return'],
            'error'     =>  serialize($params['error']),
            'method'    =>  $params['method'],
            'header'    =>  serialize($params['header']),
            'active'    =>  $params['active'],
            'user_id'   =>  $params['user_id'],
            'menu_id'   =>  $params['menu_id'],
        ]);

        return $post;
    }

    public function updatePost(Array $params,$id){
        if(count($params['description_parameter_value'])){
            foreach ($params['description_parameter_value'] as $key => $value) {
                $params['description_parameter'][$key]['key'] = $params['description_parameter_key'][$key];
                $params['description_parameter'][$key]['value'] = $params['description_parameter_value'][$key];
                $params['description_parameter'][$key]['description'] = $params['description_parameter_description'][$key];
                $params['description_parameter'][$key]['data_type'] = $params['description_parameter_data_type'][$key];
                $params['description_parameter'][$key]['required'] = $params['description_parameter_required'][$key];
            }
        }

        if(count($params['error_code'])){
            foreach ($params['error_code'] as $key => $value) {
                $params['error'][$key]['error_code']  = $params['error_code'][$key];
                $params['error'][$key]['description'] = $params['error_description'][$key];
            }
        }

        if(count($params['header_key'])){
            foreach ($params['header_key'] as $key => $value) {
                $params['header'][$key]['header_key']  = $params['header_key'][$key];
                $params['header'][$key]['header_value'] = $params['header_value'][$key];
            }
        }

        $post = $this->_model->find($id)->update([
                'title' =>  $params['title'],
                'content'   =>  $params['content'],
                'url'   =>  $params['url'],
                'description_parameter' =>  serialize($params['description_parameter']),
                'data_return'   =>  $params['data_return'],
                'error'     =>  serialize($params['error']),
                'method'    =>  $params['method'],
                'header'    =>  serialize($params['header']),
                'active'    =>  $params['active'],
                'user_id'   =>  $params['user_id'],
                'menu_id'   =>  $params['menu_id'],
            ]);

        return $post;
    }

    public function createPostDemo(Array $params){
        $post = $this->_model->create([
            'title' =>  $params['title'],
            'content'   =>  $params['content'],
            'user_id'   =>  $params['user_id'],
            'menu_id'   =>  $params['menu_id'],
        ]);
    }

    public function getMethod()
    {
        $method = '';
        switch ($this->_model->method) {
            case '1':
                $method = "GET";
                break;

            case '2':
                $method = "POST";
                break;

            case '3':
                $method = "PUT";
                break;

            case '4':
                $method = "PATCH";
                break;

            case '5':
                $method = "DELETE";
                break;
        }

        return $method;
    }

    public function getAllExport()
    {
        return $this->_model->with('menu')
                           ->orderBy('menu_id','asc')
                            ->get();
    }

}