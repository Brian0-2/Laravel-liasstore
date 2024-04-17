<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255','min:5'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'address' => ['required','max:255','min:5'],
            'postal_code' => ['required','size:5'],
            'location' => ['required','max:255','min:5'],
            'municipality' => ['required','min:5','max:255'],
            'state' => ['required','min:5','max:255'],
            'phone_number' => ['required','size:10'],
            'password' => ['required', 'confirmed', 'min:8', 'max:255'],
        ];
    }


    public function messages()
    {
        //Posibles mensajes para personalizar Ej.
        return [
            'name.required' => 'El nombre es obligatorio',
        ];
    }
}
