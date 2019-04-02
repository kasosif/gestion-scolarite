<?php

namespace App\Http\Requests;

use App\Model\Seance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeanceRequest extends FormRequest
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
                        'heure_debut' => 'required|date_format:H:i|unique:seances',
                        'heure_fin' => 'required|date_format:H:i|after:heure_debut|unique:seances',
                    ];
                }
            case 'PUT':
                {
                    $sceance = Seance::findorFail($this->route('id'));
                    return [
                        'heure_debut' => [
                            'required',
                            'date_format:H:i',
                            Rule::unique('seances')->ignore($sceance->id)
                        ],
                        'heure_fin' =>  [
                            'required',
                            'date_format:H:i',
                            'after:heure_debut',
                            Rule::unique('seances')->ignore($sceance->id)
                        ]
                    ];
                }
        }
        return [];
    }
}
