<div class="input-field form-input ">
    <select id="user" name="user_id" class="form-control select2" required>
        <option value="" selected disabled>Selectionnez Etudiant</option>
        @foreach($etudiants as $etudiant)
            <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
        @endforeach
    </select>
</div>
