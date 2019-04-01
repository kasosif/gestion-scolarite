<?php

namespace App\Http\Requests;

use App\Model\Semestre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SemestreRequest extends FormRequest
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
                        'nom' => 'required|unique:semestres',
                    ];
                }
            case 'PUT':
                {
                    $semestre = Semestre::findorFail($this->route('id'));
                    return [
                        'nom' => [
                            'required',
                            Rule::unique('semestres')->ignore($semestre->id)
                        ],
                    ];
                }
        }
        return [];
    }
}
