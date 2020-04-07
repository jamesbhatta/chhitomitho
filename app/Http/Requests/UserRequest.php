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
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|unique:users,email,' . $this->id,
            'password'  => 'required_without:id|nullable|string|min:8',
            'mobile'    => 'nullable',
            'address'   => 'nullable',
            'gender'    => 'nullable',
            'role'      => 'nullable',
            'profile_pic' => 'nullable|image:jpg,jpeg,bmp,gif,svg'
        ];
    }
}
