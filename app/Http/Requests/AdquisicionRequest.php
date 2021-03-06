<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdquisicionRequest extends FormRequest
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
            'tipo' => 'required',
            'fecha' => ['required'],
            'justificacion' => ['required','min:20'],
            'total' => 'required'
        ];
    }
    public function Adquisicion(){
        return[
            'justificacion.min' => 'La justificación debe tener por lo menos 20 caracteres'
        ];
    }
}
