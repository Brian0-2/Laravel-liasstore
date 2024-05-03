<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:250|min:3',
            'file_url' => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:1024',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'file_url' => 'Imagen',
        ];
    }

}
