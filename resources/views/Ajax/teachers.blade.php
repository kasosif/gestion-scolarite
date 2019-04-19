<div class="input-field form-input s">
    <select id="user" name="user_id" class="form-control select2" required>
        <option value="" selected disabled>Selectionnez Professeur</option>
        @foreach($professeurs as $professeur)
            <option value="{{$professeur->id}}">{{$professeur->nom}} {{$professeur->prenom}}</option>
        @endforeach
    </select>
</div>
