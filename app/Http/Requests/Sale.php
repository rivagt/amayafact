<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Sale extends FormRequest
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
            'document_client' => 'required',
            'fullname_client' => 'required',
            'sale_type' => 'required',
            'sale_code' => 'required',
            'total_mount' => 'required',
            'subtotal_mount' => 'required',
            'impost_mount' => 'required',
            'emited_time' => 'required',
            'user_code' => 'required',
            'state' => 'required',
        ];
    }
}
