<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClotheRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required','min:5','max:100'],
            'description' => ['required','min:10','max:255'],
            'unit_price' => ['numeric', 'min:0','regex:/^\d+(\.\d{1,2})?$/'],
            'provider_id' => ['required'],
        ];
    }

    public function messages()
    {
        //Posibles mensajes para personalizar Ej.
        return [
            'name.required' => 'El nombre es obligatorio',
            'unit_price.regex' => 'El precio solo debe de contener 2 decimales',
            'unit_price.min' => 'El precio no puede ser menor o igual a cero',
        ];
    }
}
