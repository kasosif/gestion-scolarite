<div class="input-field form-input">
    <select id="classe" name="classe_id" class="form-control" required>
        <option value="" selected disabled>Selectionnez Classe</option>
        @foreach($classes as $classe)
            <option value="{{$classe->id}}">{{$classe->abbreviation}}</option>
        @endforeach
    </select>
</div>
