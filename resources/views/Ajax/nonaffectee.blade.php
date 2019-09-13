<form class="form" action="@can('update',$classe){{route('ajax.affectprof')}}@endcan" method="post"  >
    <input type="hidden" name="classe_id" value="{{$classe->id}}">
    @csrf
    <div class="col-md-4">
        <div class="form-group">
            <label>Matiere
                <input type="hidden" name="matiere_id" value="{{$matiere->id}}">
                <input type="text" disabled value="{{$matiere->nom}}" class="validate">
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="user_id" class="control-label">Professeur</label>
            <select required name="user_id" class="form-control ">
                @foreach($professeurs as $professeur)
                    <option value="{{$professeur->id}}">{{$professeur->nom}} {{$professeur->prenom}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @can('update',$classe)
        <div class="col-md-4">
            <button type="submit" class="btn btn-labeled btn-primary" style=" margin-top: 15px; ">
                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Affecter Professeur
            </button>
        </div>
    @endcan
</form>
