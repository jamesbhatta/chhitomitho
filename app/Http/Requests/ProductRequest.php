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
            'name' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'sale_price_from' => 'nullable|date',
            'sale_price_to' => 'nullable|date',
            'min_quantity' => 'nullable|numeric',
            'product_image' => 'required_without:id|image|mimes:jpeg,jpg,png,gif|max:2048',
        ];
    }
}
