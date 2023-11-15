<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'nombreUsuario' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
            'cmbRolUsuario' => ['required'],

            // Reglas para cliente
            'nombreCliente' => ['required_if:cmbRolUsuario,cliente'],
            'cmbTipoCliente' => ['required_if:cmbRolUsuario,cliente'],
            'dni_cuit' => 'required_if:cmbRolUsuario,cliente|digits:8|unique:clientes,dni_cuit',
            'codigoPostal' => ['required_if:cmbRolUsuario,cliente'],
            'telefono' => ['required_if:cmbRolUsuario,cliente'],
        ];
    }

    public function messages()
    {
        return [
            'nombreUsuario.required' => 'El campo de nombre de usuario es obligatorio',
            'email.required' => 'El campo de correo electrónico es obligatorio',
            'email.unique' => 'El correo electrónico ya está en uso',
            'password.required' => 'El campo de contraseña es obligatorio',
            'password.min' => 'La contraseña debe tener al menos :min caracteres',
            'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos :min caracteres',
            'password_confirmation.same' => 'La confirmación de la contraseña no coincide con la contraseña',
            'cmbRolUsuario.required' => 'El campo de rol de usuario es obligatorio',

            // Mensajes para cliente
            'nombreCliente.required_if' => 'El campo de nombre del cliente es obligatorio para el rol de cliente',
            'cmbTipoCliente.required_if' => 'El campo de tipo de cliente es obligatorio para el rol de cliente',
            'dni_cuit.required_if' => 'El campo de DNI o CUIT es obligatorio para el rol de cliente',
            'dni_cuit.digits' => 'El DNI o CUIT debe tener exactamente :digits dígitos',
            'dni_cuit.unique' => 'El DNI o CUIT ingresado ya está en uso',
            'codigoPostal.required_if' => 'El campo de código postal es obligatorio para el rol de cliente',
            'telefono.required_if' => 'El campo de teléfono es obligatorio para el rol de cliente',
        ];
    }

}
