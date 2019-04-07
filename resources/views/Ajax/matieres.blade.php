<option value="" selected disabled>Selectionnez Matiere</option>
@foreach($matieres as $matiere)
    <option value="{{$matiere->id}}">{{$matiere->nom}}</option>
@endforeach
