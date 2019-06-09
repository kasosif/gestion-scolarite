<div class="card">
    <div class="card-header">
        <i class="fa fa-wpforms"></i>
        Liste des Etudiants
    </div>
    <div class="card-content">
        <div class="table-responsive">
            <table id="etudiantsTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                @foreach($etudiants as $etudiant)
                    <tr>
                        <td>
                            @if($etudiant->image)
                                <img src="{{asset('images/etudiants/'.$etudiant->image)}}" alt="User Image" style="width: 50px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            {{$etudiant->prenom}}
                        </td>
                        <td>
                            {{$etudiant->nom}}
                        </td>
                        <td>
                            <div class="form-group">
                                <label>
                                    <input class="form-control" placeholder="?/20"  required step="0.01" type="number" name="notes[{{$etudiant->id}}]" min="0" max="20">
                                </label>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="pull-right">
    <button type="submit" class="btn btn-labeled btn-success">
        <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Enregister
    </button>
</div>
