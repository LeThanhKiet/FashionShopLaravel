<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'name' => 'required',
            'name_account' => 'required',
            'pass_account' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên tài khoản không được để trống',
            'name_account.required'=>'Họ tên không được để trống',
            'pass_account.required'=>'Mật khẩu không được để trống ',
        ];
    }
}
