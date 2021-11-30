<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'pid' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ];
    }

    /**
     * 取得已定義驗證規則的錯誤訊息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pid.required' => '產品編號是必填的',
            'name.required' => '產品名稱是必填的',
            'quantity.required' => '購買數量是必填的',
            'price.required' => '金額是必填的'
        ];
    }
}
