<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' =>  'required',
            'content'   =>  'required',
            'url'   =>  'required',
            'data_return'   =>  'required',
            'menu_id'   =>  'required',
            'method'    =>  'required',
        ];
    }

    public function messages(){
        return [
            'title.required'                     =>  'Tiêu đề không được để trống',
            'content.required'                   =>  'Nội dung không được để trống',
            'url.required'                       =>  'Đường dẫn không được để trống',
            'data_return.required'               =>  'Dữ liệu trả về không được để trống',
            'menu_id.required'                   =>  'Menu không được để trống',
            'method.required'                    =>  'Chưa chọn phương thức',         
        ];
    }
}
