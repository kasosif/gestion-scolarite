<?php

namespace App\Http\Requests;

use App\Model\Salle;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SalleRequest extends FormRequest
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
                        'nom' => 'required|unique:salles',
                    ];
                }
            case 'PUT':
                {
                    $salle = Salle::findorFail($this->route('id'));
                    return [
                        'nom' => [
                            'required',
                            Rule::unique('salles')->ignore($salle->id)
                        ],
                    ];
                }
        }
        return [];
    }
}
