<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            case 'PATCH':
                {
                    return [
                        'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5'
                    ];
                }
            case 'PUT':
                {
                    return [
                        'nom' => 'required|min:2',
                        'prenom' => 'required|min:2',
                        'date_naissance' => 'required|date|before:-18 years',
                        'lieu_naissance' => 'required|min:2',
                        'gendre' => ['required', 'regex:(male|female)']
                    ];
                }
        }
    }
}
