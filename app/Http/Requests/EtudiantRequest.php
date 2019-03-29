<?php

namespace App\Http\Requests;

use App\Model\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EtudiantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ((Auth()->check()) && (Auth::user()->role == 'ROLE_ADMIN'))
            return true;
        return false;
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
                        'classe_id' => 'required|numeric',
                        'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                        'cin' => 'required|numeric|unique:users|digits:8',
                        'nom' => 'required|min:2',
                        'nom_ar' => 'nullable|min:2',
                        'nom_en' => 'nullable|min:2',
                        'prenom' => 'required|min:2',
                        'prenom_ar' => 'nullable|min:2',
                        'prenom_en' => 'nullable|min:2',
                        'date_naissance' => 'required|date|before:-18 years',
                        'lieu_naissance' => 'required|min:2',
                        'lieu_naissance_ar' => 'nullable|min:2',
                        'lieu_naissance_en' => 'nullable|min:2',
                        'gendre' => ['required', 'regex:(male|female)'],
                        'email' => 'required|unique:users|email',
                        'password' => ['confirmed', 'required', 'regex:#^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$#'],
                    ];
                }
            case 'PUT':
                {
                    $user = User::where('cin',$this->route('cin'))->first();
                    return [
                        'classe_id' => 'required|numeric',
                        'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                        'cin' => ['required',
                                  'numeric',
                                  'digits:8',
                                  Rule::unique('users')->ignore($user->id)
                        ],
                        'nom' => 'required|min:2',
                        'nom_ar' => 'nullable|min:2',
                        'nom_en' => 'nullable|min:2',
                        'prenom' => 'required|min:2',
                        'prenom_ar' => 'nullable|min:2',
                        'prenom_en' => 'nullable|min:2',
                        'date_naissance' => 'required|date|before:-18 years',
                        'lieu_naissance' => 'required|min:2',
                        'lieu_naissance_ar' => 'nullable|min:2',
                        'lieu_naissance_en' => 'nullable|min:2',
                        'gendre' => ['required', 'regex:(male|female)'],
                        'email' => [
                            'required',
                            Rule::unique('users')->ignore($user->id),
                            'email'
                        ],
                        'password' => ['confirmed', 'required', 'regex:#^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$#'],
                    ];
                }
        }
        return [];
    }
}
