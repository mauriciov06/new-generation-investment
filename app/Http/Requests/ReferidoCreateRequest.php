<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferidoCreateRequest extends FormRequest
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
            'email' => 'required|unique:users',
            'password' => 'required|min:6',                   
            'telefono_users' => 'required|min:7',
            'celular_users' => 'required',
            'id_pais' => 'required',
            'confirmar_contraseña' => 'required|same:password' 
        ];
    }
}
