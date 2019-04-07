<option value="" selected disabled>Selectionnez Classe</option>
@foreach($classes as $classe)
    <option value="{{$classe->id}}">{{$classe->abbreviation}}</option>
@endforeach
