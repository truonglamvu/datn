<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'          =>  'required|min:5|max:50',
            'date_of_birth' =>  'required|date',
            'address'       =>  'required|min:5|max:255',
            'gender'        =>  'required',
            'phone'         =>  'required|numeric',
            'email'         =>  'required|email|min:10|max:255|unique:users,email,' . $this->route('user'),
            'login_name'    =>  'required|min:6|max:255',
           // 'avarta'        =>  'image',
        ];
    }

    private function defaultRule(){
        return [
            'name'          =>  'required|min:5|max:50',
            //'date_of_birth' =>  'required|date',
            'address'       =>  'required|min:5|max:255',
            'gender'        =>  'required',
            'phone'         =>  'required|numeric',
            'email'         =>  'required|email|min:10|max:255|unique:users',
            'password'      =>  'required|min:6|max:255',
            'login_name'    =>  'required|min:6|max:255',
           // 'avarta'        =>  'required|image',
        ];
    }

    public function messages(){
        return [
            'name.required'             =>  'Tên không được để trống',
            'name.min'                  =>  'Tên chứa ít nhất 5 kí tự',
            'name.max'                  =>  'Tên không vượt quá 50 kí tự',
           // 'date_of_birth.required'    =>  'Ngày sinh không được để trống',
            //'date_of_birth.date' =>  'Ngày sinh không đúng định dạng ngày',
            'address.required'          =>  'Địa chỉ không được để trống',
            'address.min'               =>  'Địa chỉ chứa ít nhất 5 kí tự',
            'address.max'               =>  'Địa chỉ không vượt quá 255 kí tự',
            'gender.required'           =>  'Giới tính không được để trống',
            'phone.required'            =>  'Số điện thoại không được để trống',
            'phone.numeric'             =>  'Chỉ được nhập số',
            'email.required'            =>  'Email không được để trống',
            'email.email'               =>  'Email không đúng định dạng',
            'email.min'                 =>  'Email chứa ít nhất 10 kí tự',
            'email.max'                 =>  'Email không vượt quá 255 kí tự',
            'email.unique'              =>  'Email đã tồn tại',
            'password.required'         =>  'Mật khẩu không được để trống',
            'password.min'              =>  'Mật khẩu chứa ít nhất 6 kí tự',
            'password.max'              =>  'Mật khẩu không vượt quá 255 kí tự',
            'login_name.required'       =>  'Tên đăng nhập không được để trống',
            'login_name.min'            =>  'Tên đăng nhập chứa ít nhất 6 kí tự',
            'login_name.max'            =>  'Tên đăng nhập không vượt quá 255 kí tự',
           // 'avarta.required'           =>  'Ảnh đại diện không được để trống',
           // 'avarta.image'              =>  'Ảnh đại diện không đúng định dạng (jpeg, png, bmp, gif, or svg)',              
        ];
    }
}
