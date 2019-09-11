<div class="card">
    <div class="card-header">
        <i class="fa fa-wpforms"></i>
        Liste des Professeurs
    </div>
    <div class="card-content">
        <div class="table-responsive">
            <table id="professeursTable" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Matiere</th>
                    <th>Abscent</th>
                    <th>Justifie</th>
                </tr>
                </thead>
                <tbody>
                @foreach($affectations as $affectation)
                    <tr>
                        <td>
                            @if($affectation->user->image)
                                <img src="{{asset('images/professeurs/'.$affectation->user->image)}}" alt="User Image" style="width: 50px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            {{$affectation->user->prenom}}
                        </td>
                        <td>
                            {{$affectation->user->nom}}
                        </td>
                        <td>
                            {{$affectation->matiere->nom}}
                        </td>
                        <td>
                            <div class="col-md-3 switch m-b-20">
                                <label style="font-size: inherit">
                                    <input type="checkbox" class="abscence" name="abscences[]" value="{{$affectation->user->id}}">
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </td>
                        <td class="justification">
                            <div class="col-md-3 switch m-b-20">
                                <label style="font-size: inherit">
                                    <input disabled type="checkbox" class="justifie" name="justifie[]" value="{{$affectation->user->id}}">
                                    <span class="lever"></span>
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
