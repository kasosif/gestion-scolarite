<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class DevoirRequest extends FormRequest
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
        $annee = DB::table('annees')
            ->select('annees.*')
            ->where('annees.date_debut','<',Carbon::today())
            ->where('annees.date_fin','>',Carbon::today())
            ->first();
        $date = $annee->date_fin;
        return [
            'coeficient' => 'required|numeric',
            'date' => 'required|date|after: today|before: '.$date,
            'type' => [
                'required',
                'regex:(controle|examen)'
            ],
            'matiere_id' => 'required|numeric'
        ];
    }
}
