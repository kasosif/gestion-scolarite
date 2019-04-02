<?php

namespace App\Http\Requests;

use App\Model\Classe;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClasseRequest extends FormRequest
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
                        'annee_id' => 'required|numeric',
                        'specialite_id' => 'required|numeric',
                        'abbreviation' => 'required|min:2',
                        'code' => 'required|min:2|unique:classes',
                        'promotion' => 'required|numeric',
                        ];
                }
            case 'PUT':
                {
                    $classe = Classe::findorFail($this->route('id'));
                    return [
                        'annee_id' => 'required|numeric',
                        'specialite_id' => 'required|numeric',
                        'abbreviation' => 'required|min:2',
                        'code' => [
                            'required',
                            'min:2',
                            Rule::unique('classes')->ignore($classe->id)
                        ],
                        'promotion' => 'required|numeric',
                    ];
                }
        }
        return [];
    }
}
