<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilClienteRequest extends FormRequest
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
            'nombre' => 'required',
            'documento' => 'required|digits:8',
            'email' => 'required|email',
            'codigoPostal' => 'required',
            'telefono' => 'required'
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array<string, string>
    */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'documento.required' => 'El documento es obligatorio',
            'documento.digits' => 'El documento debe tener exactamente 8 dígitos',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida',
            'codigoPostal.required' => 'El código postal es obligatorio',
            'telefono.required' => 'El número de teléfono es obligatorio',
        ];
    }

}
