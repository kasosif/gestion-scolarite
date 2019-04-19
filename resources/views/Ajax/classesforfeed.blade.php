<div class="input-field form-input">
    <select id="classe" name="classe_id" class="form-control select2" required>
        <option value="" selected disabled>Selectionnez Classe</option>
        @foreach($classes as $classe)
            <option value="{{$classe->id}}">{{$classe->niveau->specialite->nom}} {{$classe->niveau->nom}} {{$classe->abbreviation}}</option>
        @endforeach
    </select>
</div>
