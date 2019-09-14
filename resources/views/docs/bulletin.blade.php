<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Bulletin</title>

</head>
<body>
<h1>Année Scolaire : {{$annee->nom}}</h1>
<h2>Etudiant : {{$etudiant->prenom}} {{$etudiant->nom}}, Date de naissance : {{$etudiant->date_naissance}}</h2>
<h2>Classe : {{$classe->abbreviation}} {{$classe->niveau->specialite->nom}} {{$classe->niveau->nom}} </h2>
<h2>Nombre Etudiants : {{$classe->users->count()}} etudiant(s)</h2>
<br>
<table border="1">
    <thead>
    <td>Matieres</td>
    <td>Coef</td>
    <td>Controle 1</td>
    <td>Controle 2</td>
    <td>Examen</td>
    <td>Moyenne Matiére</td>
    <td>Rang Matiére</td>
    <td>Total</td>
    <td>Remarques Professeur</td>
    </thead>
    <tbody>
    <?php
    $sommecoef = 0;
    $sommetotal = 0;
    ?>
    @foreach($matieres as $matiere)
        <?php
        $sommecoef = $sommecoef + $matiere->coeficient
        ?>
        <tr>
            <td>{{$matiere->nom}}</td>
            <td>{{$matiere->coeficient}}</td>
            <td>
                @if($matiere->devoirs()->where('type','controle 1')->count() > 0 )
                    {{$etudiant->notes()->where('devoir_id',$matiere->devoirs()->where('type','controle 1')->first()->id)->first()->mark}}
                @else
                    --
                @endif
            </td>
            <td>
                @if($matiere->devoirs()->where('type','controle 2')->count() > 0 )
                    {{$etudiant->notes()->where('devoir_id',$matiere->devoirs()->where('type','controle 2')->first()->id)->first()->mark}}
                @else
                    --
                @endif

            </td>
            <td>
                @if($matiere->devoirs()->where('type','examen')->count() > 0 )
                    {{$etudiant->notes()->where('devoir_id',$matiere->devoirs()->where('type','examen')->first()->id)->first()->mark}}
                @else
                    --
                @endif
            </td>
            <td>
                <?php
                $somme = 0;
                foreach ($matiere->devoirs as $devoir) {
                    $somme = $somme + ($devoir->notes()->where('user_id',$etudiant->id)->first()->mark * $devoir->coeficient) ;
                }
                $moyenne = $somme / $matiere->devoirs()->sum('coeficient');
                ?>
                {{number_format($moyenne, 2, '.', ',')}}
            </td>
            <td>
                <?php
                $rang = 1;
                $devoir_ids = $matiere->devoirs->pluck('id');
                $mienne = $etudiant->notes()->whereIn('devoir_id',$devoir_ids)->sum('mark');
                foreach ($classe->users()->where('id','!=',$etudiant->id)->get() as $camarade) {
                    if ($camarade->notes()->whereIn('devoir_id',$devoir_ids)->sum('mark') > $mienne) {
                        $rang = $rang + 1;
                    }
                }
                ?>
                {{$rang}}
            </td>
            <td>
                {{number_format($moyenne * $matiere->coeficient, 2, '.', ',')}}
            </td>
            <td>
                <?php
                $sommetotal = $sommetotal + ($moyenne * $matiere->coeficient);
                $professeur = \App\Model\Affectation::where('matiere_id',$matiere->id)
                    ->where('classe_id',$classe->id)
                    ->first()
                    ->user;
                ?>
                {{$professeur->gendre == 'male' ? 'Mr' : 'Mme'}} {{$professeur->prenom}} {{$professeur->nom}}
            </td>
        </tr>
    @endforeach
    <tr>
        <th>Total</th>
        <th>
            {{$sommecoef}}
        </th>
        <td colspan="5">
            --
        </td>

        <th>
            {{number_format($sommetotal, 2, '.', ',')}}
        </th>
        <td>
            --
        </td>
    </tr>
    </tbody>
</table>
<br>
<table border="1">
    <thead>
    <td>Semestre</td>
    <td>Moyenne</td>
    <td>Rang</td>
    <td>Attestation</td>
    <td>Abscences</td>
    <td>Passage</td>
    </thead>
    <tbody>
    <tr>
        <th>{{$semestre->nom}}</th>
        <th>{{number_format($sommetotal / $sommecoef, 2 , '.', ',')}}</th>
        <th>
            --
        </th>
        <th>
            @if($sommetotal / $sommecoef >= 15)
                REMERCIEMENT
            @elseif($sommetotal / $sommecoef >= 13)
                HONNEUR
            @elseif($sommetotal / $sommecoef >= 11)
                CONTENTEMENT
            @elseif($sommetotal / $sommecoef >= 10)
                ENCOURAGEMENT
            @else
                --
            @endif
        </th>
        <th>
            {{$heures}} Heures
        </th>
        <th>
            @if($sommetotal / $sommecoef >= 10)
                ACCEPTE
            @else
                REFUSE
            @endif
        </th>
    </tr>
    </tbody>
</table>
</body>
</html>
