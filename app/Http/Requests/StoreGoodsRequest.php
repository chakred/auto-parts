<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsRequest extends FormRequest
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
            'name_good' => 'required',
            'desc_good' => 'required',
            'img_path' => 'image|nullable|max:1999',
            'mark_good' => 'required',
            'country' =>'required',
            'cost' => 'required',
            'profit' => 'required',
            'currency' => 'required',
            'quantity' => 'required',
            'auto' => 'required',
            'sub-category' => 'required'
        ];
    }
}
