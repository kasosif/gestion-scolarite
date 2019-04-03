<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DevoirRequest extends FormRequest
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
            'nom' => 'required|min:2',
            'coeficient' => 'required|numeric',
            'date' => 'required|date|after: today',
            'type' => [
                'required',
                'regex:(cc|ds|examen)'
            ],
            'matiere_id' => 'required|numeric'
        ];
    }
}
