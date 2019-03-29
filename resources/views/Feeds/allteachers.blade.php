<div class="input-field form-input">
    <select id="user" name="user_id" class="form-control" required>
        <option value="" selected disabled>Selectionnez Professeur</option>
        @foreach($professeurs as $professeur)
            <option value="{{$professeur->id}}">{{$professeur->nom}} {{$professeur->prenom}}</option>
        @endforeach
    </select>
</div>
