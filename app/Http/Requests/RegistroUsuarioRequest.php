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
        $rules = [
            'nombreUsuario' => ['required', 'max:50'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:50'],
            'password_confirmation' => ['required', 'min:8', 'max:50', 'same:password'],
            'cmbRolUsuario' => ['required'],
        ];

        if ($this->input('cmbRolUsuario') === 'cliente') {
            $tipoCliente = $this->input('cmbTipoCliente');

            if ($tipoCliente === 'fisico') {
                $rules['dni_cuit'] = ['required', 'digits:8', 'unique:clientes,dni_cuit'];
            } elseif ($tipoCliente === 'juridico') {
                $rules['dni_cuit'] = ['required', 'digits:11', 'unique:clientes,dni_cuit'];
            }

            $rules['nombreCliente'] = ['required', 'min:2', 'max:20'];
            $rules['cmbTipoCliente'] = ['required'];
            $rules['codigoPostal'] = ['required', 'digits:4', 'numeric'];
            $rules['telefono'] = ['required', 'numeric', 'digits_between:10,12', 'not_in:-1'];
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'nombreUsuario.required' => 'El campo de nombre de usuario es obligatorio',
            'nombreUsuario.max' => 'El nombre de usuario no debe tener más de :max caracteres',
            'email.required' => 'El campo de correo electrónico es obligatorio',
            'email.unique' => 'El correo electrónico ya está en uso',
            'password.required' => 'El campo de contraseña es obligatorio',
            'password.min' => 'La contraseña debe tener al menos :min caracteres',
            'password.max' => 'La contraseña no debe tener más de :max caracteres',
            'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos :min caracteres',
            'password_confirmation.max' => 'La confirmación de la contraseña no debe tener más de :max caracteres',
            'password_confirmation.same' => 'La confirmación de la contraseña no coincide con la contraseña',
            'cmbRolUsuario.required' => 'El campo de rol de usuario es obligatorio',
            'dni_cuit.required' => 'El campo de DNI o CUIT es obligatorio',
            'dni_cuit.digits' => 'El DNI o CUIT debe tener exactamente :digits dígitos',
            'dni_cuit.unique' => 'El DNI o CUIT ingresado ya está en uso',
            'nombreCliente.required' => 'El campo de nombre del cliente es obligatorio',
            'nombreCliente.min' => 'El nombre del cliente debe tener al menos :min caracteres',
            'nombreCliente.max' => 'El nombre del cliente no debe tener más de :max caracteres',
            'cmbTipoCliente.required' => 'El campo de tipo de cliente es obligatorio',
            'codigoPostal.required' => 'El campo de código postal es obligatorio',
            'codigoPostal.digits' => 'El código postal debe tener exactamente :digits dígitos',
            'codigoPostal.numeric' => 'El código postal debe ser numérico',
            'telefono.required' => 'El campo de teléfono es obligatorio',
            'telefono.numeric' => 'El teléfono debe ser numérico',
            'telefono.digits_between' => 'El teléfono debe tener entre :min y :max dígitos',
            'telefono.not_in' => 'El teléfono no puede ser negativo ni tener menos de :min o más de :max dígitos',
        ];
    }
}
