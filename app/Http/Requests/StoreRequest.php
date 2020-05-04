<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'  => 'required|string',
            'user_id' => 'required|unique:App\Store,user_id,' . $this->id . '|exists:users,id',
            'commission_percentage' => 'required|numeric',
            'credit_limit' => 'required|numeric',
            'logo' => 'nullable|sometimes|image|mimes:jpeg,jpg,png,bmp,gif,svg,webp',
            'website_url' => 'nullable',
            'description' => 'nullable',
        ];
    }
}
