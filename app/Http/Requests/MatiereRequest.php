<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatiereRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST':
                {
                    return [
                        'nom' => 'required|min:2',
                        'coeficient' => 'required|numeric',
                        'plafond_abscences' => 'required|numeric',
                        'niveau_id' => 'required|numeric'
                    ];
                }
            case 'PUT':
                {
                    return [
                        'nom' => 'required|min:2',
                        'coeficient' => 'required|numeric',
                        'plafond_abscences' => 'required|numeric',
                        'niveau_id' => 'required|numeric'
                    ];
                }
        }
        return [];
    }
}
