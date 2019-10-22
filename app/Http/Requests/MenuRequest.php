<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'menu_name'         =>  'required|min:3|max:20|unique:menus,menu_name,' . $this->route('menu'),
        ];
    }

    private function defaultRule(){
        return [
            'menu_name'         =>  'required|min:3|max:20|unique:menus',
        ];
    }

    public function messages(){
        return [
            'menu_name.required'    =>  'Tên menu không được để trống',
            'menu_name.min'         =>  'Tên menu chứa ít nhất 3 kí tự',
            'menu_name.max'         =>  'Tên menu không vượt quá 20 kí tự',
            'menu_name.unique'      =>  'Menu đã tồn tại',
        ];
    }
}
