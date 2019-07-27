<?php

namespace App\Http\Requests;

use App\Model\Formation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormationRequest extends FormRequest
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
                        'slug' => 'required|unique:formations',
                        'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                        'titre' => 'required|unique:formations|min:5',
                        'description' => 'required|min:10',
                        'niveau_id' => 'required|numeric',
                        'partie.*' => 'required',
                        'user_id' => 'required|numeric'
                    ];
                }
            case 'PUT':
                {
                    $formation = Formation::findorFail($this->route('id'));
                    return [
                        'titre' => [
                            'required',
                            'min:5',
                            Rule::unique('formations')->ignore($formation->id)
                        ],
                        'slug' => [
                            'required',
                            Rule::unique('formations')->ignore($formation->id)
                        ],
                        'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                        'description' => 'required|min:10',
                        'niveau_id' => 'required|numeric',
                        'user_id' => 'required|numeric'
                    ];
                }
        }
        return [];
    }
}
