<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbscenceProfesseurRequest extends FormRequest
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
            'date' => 'required|date|after:-4 days|before:+1 day',
            'abscences.*' => 'required',
            'justifie.*' => 'nullable',
            'seance_id' => 'required|numeric',
            'classe_id' => 'required|numeric',
        ];;
    }
}
