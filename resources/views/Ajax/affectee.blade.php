<form class="form" action="@can('update',$classe){{route('ajax.desaffectprof')}}@endcan" method="post">
    <input type="hidden" name="classe_id" value="{{$classe->id}}">
    @csrf
    <div class="col-md-4">
        <div class="form-group">
            <label>Matiere</label>
            <input type="hidden" name="matiere_id" value="{{$matiere->id}}">
            <p><b>{{$matiere->nom}}</b></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Professeur</label>
            <input type="hidden" name="user_id" value="{{$professeur->id}}">
            <p><b>{{$professeur->nom}} {{$professeur->prenom}}</b></p>
        </div>
    </div>
    @can('update',$classe)
        <div class="col-md-4">
            <button type="submit" class="btn btn-labeled btn-danger">
                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Annuler l'affectation
            </button>
        </div>
    @endcan
</form>
