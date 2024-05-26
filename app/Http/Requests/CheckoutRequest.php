<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'customer_name' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'address' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required'=>'Tên không được để trống',
            'email.required'=>'Email không được để trống',
            'phone.required'=>'SĐT không được để trống',
            'phone.regex' => 'Số điện thoại phải có 10 số, bắt đầu bằng bằng số 0',
            'address.required'=>'Địa chỉ nhận hàng không được để trống',
        ];
    }
}
