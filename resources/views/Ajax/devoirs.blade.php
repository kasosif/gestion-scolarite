<option value="" selected disabled>Selectionnez Devoir</option>
@foreach($matieres as $matiere)
    <optgroup label="{{$matiere->nom}}">
        @foreach($matiere->devoirs as $devoir)
            @if($devoir->date < \Carbon\Carbon::today())
                <option value="{{$devoir->id}}">{{$devoir->nom}} {{strtoupper($devoir->type)}}</option>
            @endif
        @endforeach
    </optgroup>
@endforeach
