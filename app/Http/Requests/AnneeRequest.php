<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnneeRequest extends FormRequest
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
            'nom_ar' => 'nullable|min:2',
            'date_debut' => 'required|date|after: -2 years',
            'date_fin' => 'required|date|after: date_debut',
            'code' => 'required'
        ];
    }
}
