<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoletaDetail extends FormRequest
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
            'sale_code' => 'required',
            'measure' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'unity_price' => 'required',
            'total_mount' => 'required',
            'subtotal_mount' => 'required',
            'impost_mount' => 'required',
        ];
    }
    public function messages(){
        return[
            'sale_code.required' => 'Debe llenar el campo codigo',
            'measure.required' => 'Debe llenar el campo unidad de medida',
            'quantity.required' => 'Debe llenar el campo cantidad',
            'description.required' => 'Debe llenar el campo descripcion',
            'unity_price.required' => 'Debe llenar el campo precio unitario',
            'total_mount.required' => 'Debe llenar el campo Monto total',
            'subtotal_mount.required' => 'Debe llenar el campo Subtotal',
            'impost_mount.required' => 'Debe llenar el campo IGV',
        ];
    }
}
