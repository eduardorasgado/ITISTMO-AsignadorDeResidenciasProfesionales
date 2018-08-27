<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePeriodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Dejar pasar todas las peticiones
        //sin un filtro antes, por ahora
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
            'name' => ['required', 'min:5','max:120']
        ];
    }

        public function messages(){
        return [
            //aqui estan los mensajes customizables
            'name.required' => "Por favor intenta con un nombre de más de 5 caracteres",
            'name.max' => 'El nombre del periodo es muy largo',
            'name.min' => 'El nombre del periodo es muy corto.'
        ];
    }
}
