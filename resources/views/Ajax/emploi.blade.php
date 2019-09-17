<div class="card">
    <div class="card-header">
        <i class="fa fa-table fa-lg"></i>
        Ajouter un Emploi
    </div>
    <form action="{{route('emplois.store')}}" method="post">
        @csrf
        <input type="hidden" name="semaine" value="{{$semaine}}">
        <input type="hidden" name="classe_id" value="{{$classe->id}}">
        <input type="hidden" name="date_debut" value="{{$date_debut}}">
        <input type="hidden" name="date_fin" value="{{$date_fin}}">
        <div class="card-body">
            <div class="table-responsive">
                <table  class="table table-striped table-bordered table-hover table-checkable" id="datatable_orders" >
                    <thead>
                    <tr>
                        <td>Jour/Seance</td>
                        @foreach($seances as $seance)
                            <td>{{date('H:i', strtotime($seance->heure_debut))}} => {{date('H:i', strtotime($seance->heure_fin))}}</td>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jours as $jour)
                        <tr id="{{ $jour->id }}">
                            <td width="10%;">{{ $jour->nom }}</td>
                            @foreach($seances as $seance)
                                <td id="{{ $seance->id }}">
                                    <div class="input-group">
                                        <select title="Matiere" name="mat[{{ $jour->id }}][{{$seance->id }}]" class="form-control select2">
                                            <option value="" selected disabled>Matiere</option>
                                            @foreach(\App\Http\Controllers\EmploiController::ProfesseursDisponible($classe->id,$seance->id,$jour->id,$date_debut) as $affectation)
                                                <option value="{{ $affectation->matiere->id }}">{{ $affectation->matiere->nom }} ({{$affectation->user->nom}} {{$affectation->user->prenom}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <select title="Salle" name="salle[{{ $jour->id }}][{{ $seance->id }}]"  class="form-control select2 col-cm-6">
                                            <option value="" selected disabled>Salle</option>
                                            @foreach(\App\Http\Controllers\EmploiController::SallesDisponible($seance->id,$jour->id,$date_debut) as $salle)
                                                <option value="{{ $salle->id }}">{{ $salle->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pull-right m-t-5">
                <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>Enregistrer</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
</div>
