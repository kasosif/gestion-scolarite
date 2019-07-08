<?php

namespace App\Http\Requests;

use App\Model\Feed;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FeedRequest extends FormRequest
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
                        'slug' => 'required|unique:feeds',
                        'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                        'titre' => 'required|unique:feeds|min:5',
                        'contenu' => 'required|min:10',
                        'date' => 'nullable|date',
                        'type' => ['required', 'regex:(public|classes|etudiants|professeurs)'],
                        'users.*' => 'numeric',
                        'classes.*' => 'numeric'
                    ];
                }
            case 'PUT':
                {
                    $feed = Feed::findorFail($this->route('id'));
                    return [
                        'titre' => [
                            'required',
                            'min:5',
                            Rule::unique('feeds')->ignore($feed->id)
                        ],
                        'slug' => [
                            'required',
                            Rule::unique('feeds')->ignore($feed->id)
                        ],
                        'image.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2200|min:5',
                        'contenu' => 'required|min:10',
                        'date' => 'nullable|date',
                        'type' => ['required', 'regex:(public|classes|etudiants|professeurs)'],
                        'users.*' => 'numeric',
                        'classes.*' => 'numeric'
                    ];
                }
        }
        return [];
    }
}
