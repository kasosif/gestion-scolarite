<div class="input-field form-input">
    <select id="classe" name="classes[]" class="form-control select2" required multiple>
        @foreach($classes as $classe)
            <option value="{{$classe->id}}">{{$classe->niveau->specialite->nom}} {{$classe->niveau->nom}} {{$classe->abbreviation}}</option>
        @endforeach
    </select>
</div>
