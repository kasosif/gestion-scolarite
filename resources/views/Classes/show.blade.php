@extends('layouts.app')
@section('title')
    Information Sur Classe "{{$classe->abbreviation}}"
@endsection
@section('csspage')
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('basesactive')
    class = "active"
@endsection
@section('classeactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> {{$classe->abbreviation}}</h1>
            <small>Interface d'information de classe</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('classe.index')}}">Liste Classes</a></li>
                <li>{{$classe->abbreviation}}</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('classe.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Info Classe
                </div>
                <div class="card-content">
                    <div class="row">
                        <ul>
                            <li>Abbreviation : {{$classe->abbreviation}}</li>
                            <li>Code : {{$classe->code}}</li>
                            <li>Promotion : {{$classe->promotion}}</li>
                            <li>Specialité : <b>{{$classe->niveau->specialite->nom}}</b></li></li>
                            <li>Niveau : <b>{{$classe->niveau->nom}}</b></li>
                        </ul>
                    </div>
                    <div class="row">
                        <h2>Mes Matiéres</h2>
                        @foreach($classe->niveau->matieres as $key => $matiere)
                            @if($classe->affectations->where('classe_id',$classe->id)->where('matiere_id',$matiere->id)->count())
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Matiere</label>
                                            <p><b>{{$matiere->nom}}</b></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Professeur</label>
                                            <p><b>{{$classe->affectations->where('classe_id',$classe->id)->where('matiere_id',$matiere->id)->first()->user->nom}} {{$classe->affectations->where('classe_id',$classe->id)->where('matiere_id',$matiere->id)->first()->user->prenom}}</b></p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <form class="form" action="{{route('ajax.affectprof')}}" method="post">
                                        <input type="hidden" name="classe_id" value="{{$classe->id}}">
                                        @csrf
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="matiere{{$key}}">Matiere</label>
                                                <input type="hidden" name="matiere_id" value="{{$matiere->id}}">
                                                <input id="matiere{{$key}}" type="text" disabled value="{{$matiere->nom}}" class="validate">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="user_id" class="control-label">Professeur</label>
                                                <select required id="user_id" name="user_id" class="form-control">
                                                    @foreach($professeurs as $professeur)
                                                        <option value="{{$professeur->id}}">{{$professeur->nom}} {{$professeur->prenom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-labeled btn-primary">
                                                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Affecter Professeur
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @if($classe->users()->count() > 0)
                        <div class="row">
                            <h2>Mes Etudiants</h2>
                            <div class="table-responsive">
                                <table id="etudiantTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classe->users as $etudiant)
                                        <tr>
                                            <td>
                                                {{$etudiant->nom}}
                                            </td>
                                            <td>
                                                {{$etudiant->prenom}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- ./cotainer -->
    </div>
@endsection
@section('scriptpage')
    <!-- dataTables js -->
    <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {

            @if($classe->niveau->matieres()->count() > 0)
            $('#matieresTable').DataTable();
            @endif
            @if($classe->users()->count() > 0)
            $('#etudiantTable').DataTable();
            @endif
            $(".form").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        iziToast.success({
                            title: 'Professeur Affecté',
                            message: 'Succes',
                            position: 'topCenter'
                        });
                        form.parent().html('<div class="col-md-4"> <div class="form-group"> <label>Matiere</label> <p><b>'+data['matiere']+'</b></p> </div> </div> <div class="col-md-4"> <div class="form-group"> <label>Professeur</label> <p><b>'+data['professeur']+'</b></p>\ </div> </div>');

                    }
                });


            });
        });
    </script>

@endsection
