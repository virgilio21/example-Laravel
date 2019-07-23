<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        //Poner a true por el momento
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //La key es el name que le pusimos al input en el formulario
        return [
            'message'=>['required','max:100'],
        ];
    }

    public function messages()
    {
        return [
            'message.required'=> 'Tienes que escribir algo',
            'message.max'=> 'No puedes escribir un mensaje de más de 100 caracteres',
        ];
    }
}
