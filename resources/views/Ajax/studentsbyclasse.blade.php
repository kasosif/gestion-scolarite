<option value="" selected disabled>Selectionnez Etudiant</option>
@foreach($etudiants as $etudiant)
    <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
@endforeach

