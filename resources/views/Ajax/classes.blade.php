<option value="" selected disabled>Selectionnez Classe</option>
@foreach($spec->niveaux as $niveau)
    <optgroup label="{{$niveau->nom}}">
        @foreach($niveau->classes as $classe)
            <option value="{{$classe->id}}">{{$classe->abbreviation}} {{$niveau->nom}}</option>
        @endforeach
    </optgroup>
@endforeach
