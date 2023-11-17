<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
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
            'nombre_producto' => 'required|max:100',
            'descripcion' => 'nullable|max:500',
            'cmbTipoMueble' => 'required',
            'largo' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:1'],
            'ancho' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:1'],
            'alto' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:1'],
            'cmbmaterialMueble' => 'required',
            'imagenProdEdit' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nombre_producto.required' => 'El nombre del producto es obligatorio.',
            'nombre_producto.max' => 'El nombre del producto no puede tener más de :max caracteres.',
            'descripcion.max' => 'La descripción no puede tener más de :max caracteres.',
            'id_tipo_mueble.required' => 'El tipo de mueble es obligatorio.',
            'largo.required' => 'El largo es obligatorio.',
            'largo.numeric' => 'El largo debe ser numérico.',
            'largo.regex' => 'El largo debe tener hasta dos decimales.',
            'largo.min' => 'El largo debe ser al menos :min.',
            'ancho.required' => 'El ancho es obligatorio.',
            'ancho.numeric' => 'El ancho debe ser numérico.',
            'ancho.regex' => 'El ancho debe tener hasta dos decimales.',
            'ancho.min' => 'El ancho debe ser al menos :min.',
            'alto.required' => 'La altura es obligatoria.',
            'alto.numeric' => 'La altura debe ser numérica.',
            'alto.regex' => 'La altura debe tener hasta dos decimales.',
            'alto.min' => 'La altura debe ser al menos :min.',
            'cmbmaterialMueble.required' => 'El material es obligatorio.',
            'imagenProd.required' => 'La imagen del producto es obligatoria.',
            'imagenProd.image' => 'El archivo debe ser una imagen.',
            'imagenProd.mimes' => 'La imagen debe tener uno de los siguientes formatos: jpeg, png, jpg, gif.',
            'imagenProd.max' => 'La imagen no puede ser más grande de :max kilobytes.',
        ];
    }


}
