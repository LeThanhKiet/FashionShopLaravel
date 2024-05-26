<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => [
                'required',
                'unique:App\Models\Product,name'
            ],
            'image' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng điền tên sản phẩm.',
            'image.required' => 'Vui lòng chọn ảnh.',
            'name.unique' => 'Sản phẩm đã tồn tại, vui lòng nhập sản phẩm khác.'
        ];
    }
}
