<?php

namespace App\Http\Requests;

use App\Model\Specialite;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecialiteRequest extends FormRequest
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
                        'nom' => 'required|unique:specialites',
                        'nom_ar' => 'nullable|min:2',
                        'nom_en' => 'nullable|min:2',
                        'code' => 'required|unique:specialites',
                    ];
                }
            case 'PUT':
                {
                    $specialite = Specialite::findorFail($this->route('id'));
                    return [
                        'nom' => [
                            'required',
                            Rule::unique('specialites')->ignore($specialite->id)
                        ],
                        'nom_ar' => 'nullable|min:2',
                        'nom_en' => 'nullable|min:2',
                        'code' => [
                            'required',
                            Rule::unique('specialites')->ignore($specialite->id)
                        ],
                    ];
                }
        }
        return [];
    }
}
