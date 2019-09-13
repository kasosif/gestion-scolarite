@extends('layouts.app')
@section('title')
    Information Sur Classe "{{$classe->abbreviation}}"
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container{
            width: 100%!important;
        }
    </style>
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
                                                <input type="hidden" name="user_id" value="{{$classe->affectations->where('classe_id',$classe->id)->where('matiere_id',$matiere->id)->first()->user->id}}">
                                                <p><b>{{$classe->affectations->where('classe_id',$classe->id)->where('matiere_id',$matiere->id)->first()->user->nom}} {{$classe->affectations->where('classe_id',$classe->id)->where('matiere_id',$matiere->id)->first()->user->prenom}}</b></p>
                                            </div>
                                        </div>
                                        @can('update',$classe)
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-labeled btn-danger" style=" margin-top: 15px; ">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Annuler l'affectation
                                                </button>
                                            </div>
                                        @endcan
                                    </form>
                                </div>

                            @else
                                <div class="row">
                                    <form class="form" action="@can('update',$classe){{route('ajax.affectprof')}}@endcan" method="post">
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
                                                <select required id="user{{$key}}" name="user_id" class="form-control">
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
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <!-- dataTables js -->
    <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('select').select2();
            @if($classe->niveau->matieres()->count() > 0)
            $('#matieresTable').DataTable();
            @endif
            @if($classe->users()->count() > 0)
            $('#etudiantTable').DataTable();
            @endif
            @can('update',$classe)
            $("body").on("submit",".form",function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var form = $(this);
                var url = form.attr('action');
                var pieces = url.split('/');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        if (pieces[pieces.length-1] === 'affecterprofesseur') {
                            iziToast.success({
                                title: 'Professeur Affecté',
                                message: 'Succes',
                                position: 'topCenter'
                            });
                            form.parent().html(data);
                        } else {
                            iziToast.success({
                                title: 'Affectation Annulée',
                                message: 'Succes',
                                position: 'topCenter'
                            });
                            var $newform=$(data);
                            $newform.find('select').select2();
                            form.parent().html($newform);

                        }

                    }
                });


            });
            @endcan
        });
    </script>
@endsection
