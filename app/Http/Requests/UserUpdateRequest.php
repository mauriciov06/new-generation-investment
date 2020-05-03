<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'numero_documento' => 'required|numeric',
            'tipo_documento' => 'required',
            'telefono_users' => 'required|min:7',
            'celular_users' => 'required',
            'id_pais' => 'required',
            'password' => 'required|min:6',
            'confirmar_contraseña' => 'required|same:password' 
        ];
    }
}
