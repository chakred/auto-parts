<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'good_id'       => 'required|numeric',
            'quantity'      => 'required|numeric|max:10',
            'bought_price'  => 'required|numeric',
            'buyer_name'    => 'required|max:20',
            'buyer_phone'   => 'required|max:13'
        ];
    }
}
