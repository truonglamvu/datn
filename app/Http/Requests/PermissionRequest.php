<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        switch ($this->method()) {
            case 'PUT':
                return $this->putRule();
                break;
            
            default:
                return $this->defaultRule();
                break;
        }
    }

    private function putRule(){
        return [
            'name'          =>  'required|min:3|max:20|unique:permissions,name,' . $this->route('permission'),
            'display_name'  =>  'required|min:6|max:255',
            'description'   =>  'required|min:6|max:255',
        ];
    }

    private function defaultRule(){
        return [
            'name'          =>  'required|min:3|max:20|unique:permissions',
            'display_name'  =>  'required|min:6|max:255',
            'description'   =>  'required|min:6|max:255',
        ];
    }

    public function messages(){
        return [
            'name.required'         =>  'Tên quyền không được để trống',
            'name.min'              =>  'Tên quyền chứa ít nhất 3 kí tự',
            'name.max'              =>  'Tên quyền không vượt quá 20 kí tự',
            'name.unique'           =>  'Quyền đã tồn tại',
            'display_name.required' =>  'Tên hiển thị không được để trống',
            'display_name.min'      =>  'Tên hiển thị chứa ít nhất 6 kí tự',
            'display_name.max'      =>  'Tên hiển thị không vượt quá 255 kí tự',
            'description.required'  =>  'Mô tả không được để trống',
            'description.min'       =>  'Mô tả chứa ít nhất 6 kí tự',
            'description.max'       =>  'Mô tả không vượt quá 255 kí tự',
        ];  
    }
}
