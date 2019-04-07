<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbscenceRequest extends FormRequest
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
            'date' => 'required|date|after:yesterday',
            'justifie' => 'required|boolean',
            'justification.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
            'commentaire' =>'nullable|min:2',
            'user_id' => 'required|numeric',
            'matiere_id' => 'required|numeric',
            'seance_id' => 'required|numeric'
        ];
    }
}
