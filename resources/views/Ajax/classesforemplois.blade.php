<option value="" selected disabled>Selectionnez Classe</option>
@foreach($specialites as $specialite)
    <optgroup label="{{$specialite->nom}}">
        @foreach($specialite->niveaux as $niveau)
            @foreach($niveau->classes as $classe)
                <option value="{{$classe->id}}">{{$classe->abbreviation}} {{$niveau->nom}}</option>
            @endforeach
        @endforeach
    </optgroup>
@endforeach
