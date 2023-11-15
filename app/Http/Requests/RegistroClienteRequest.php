<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroClienteRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nombreUsuario' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'nombreCliente' => 'required',
            'cmbTipoCliente' => 'required',
            'dni_cuit' => 'required|digits:8|unique:clientes,dni_cuit',
            'codigoPostal' => 'required',
            'telefono' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombreUsuario.required' => 'El nombre de usuario es obligatorio',
            'email.required' => 'El campo de correo electrónico es obligatorio',
            'email.unique' => 'El correo electrónico ya está en uso',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos :min caracteres',
            'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos :min caracteres',
            'password_confirmation.same' => 'La confirmación de la contraseña no coincide con la contraseña',
            'nombreCliente.required' => 'El nombre del cliente es obligatorio',
            'cmbTipoCliente.required' => 'El tipo de cliente es obligatorio',
            'dni_cuit.required' => 'El DNI o CUIT es obligatorio',
            'dni_cuit.digits' => 'El DNI o CUIT debe tener exactamente :digits dígitos',
            'dni_cuit.unique' => 'El DNI o CUIT ingresado ya está en uso',
            'codigoPostal.required' => 'El código postal es obligatorio',
            'telefono.required' => 'El teléfono es obligatorio',
        ];
    }
}
