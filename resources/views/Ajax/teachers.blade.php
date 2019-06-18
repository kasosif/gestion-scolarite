<div class="input-field form-input s">
    <select id="user" name="users[]" class="form-control select2" required multiple>
        @foreach($professeurs as $professeur)
            <option value="{{$professeur->id}}">{{$professeur->nom}} {{$professeur->prenom}}</option>
        @endforeach
    </select>
</div>
