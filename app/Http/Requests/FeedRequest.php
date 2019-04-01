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
                        'titre' => 'required|unique:feeds|min:5',
                        'contenu' => 'required|min:10',
                        'date' => 'nullable|date',
                        'type' => ['required', 'regex:(classe|etudiant|professeur)'],
                        'classe_id' => 'nullable',
                        'user_id' => 'nullable',
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
                        'contenu' => 'required|min:10',
                        'date' => 'nullable|date',
                        'type' => ['required', 'regex:(classe|etudiant|professeur)'],
                        'classe_id' => 'nullable|numeric',
                        'user_id' => 'nullable|numeric',
                    ];
                }
        }
        return [];
    }
}
