<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'billing_name' => 'required|string',
            'billing_phone' => 'required|string',
            'billing_address' => 'required|string',
            'payment_option' => 'required|alpha',
            'transaction_time' => 'nullable|date',
            'order_notes' => 'nullable',
        ];
    }
}
