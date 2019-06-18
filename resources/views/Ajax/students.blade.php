<div class="input-field form-input ">
    <select id="user" name="users[]" class="form-control select2" required multiple>
        @foreach($etudiants as $etudiant)
            <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
        @endforeach
    </select>
</div>
