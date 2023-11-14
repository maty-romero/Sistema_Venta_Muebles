<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombreUsuario' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
            'cmbRolUsuario' => ['required'],

            // Reglas para cliente
            'nombreCliente' => ['required_if:cmbRolUsuario,cliente'],
            'cmbTipoCliente' => ['required_if:cmbRolUsuario,cliente'],
            'dni_cuit' => ['required_if:cmbRolUsuario,cliente', 'min:8'],
            'codigoPostal' => ['required_if:cmbRolUsuario,cliente'],
            'telefono' => ['required_if:cmbRolUsuario,cliente'],
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
            'cmbRolUsuario.required' => 'El campo de rol de usuario es obligatorio',

            // Mensajes para cliente
            'nombreCliente.required_if' => 'El nombre del cliente es obligatorio para el rol de cliente',
            'cmbTipoCliente.required_if' => 'El tipo de cliente es obligatorio para el rol de cliente',
            'dni_cuit.required_if' => 'El DNI o CUIT es obligatorio para el rol de cliente',
            'dni_cuit.min' => 'El DNI o CUIT debe tener al menos :min caracteres',
            'codigoPostal.required_if' => 'El código postal es obligatorio para el rol de cliente',
            'telefono.required_if' => 'El teléfono es obligatorio para el rol de cliente',
        ];
    }
}
