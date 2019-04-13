<option value="" selected disabled>Selectionnez Matiere</option>
@foreach($matieres as $matiere)
    <optgroup label="{{$matiere->nom}}">
        @foreach($matiere->devoirs as $devoir)
            <option value="{{$devoir->id}}">{{$devoir->nom}} {{strtoupper($devoir->type)}}</option>
        @endforeach
    </optgroup>
@endforeach
