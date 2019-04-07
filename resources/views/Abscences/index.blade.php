@extends('layouts.app')
@section('title')
    Liste des Abscences
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('abscenceetudiantactive')
    class = "active-link"
@endsection
@section('etudiantactive')
    class = "active"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Abscences</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('abscence.index')}}">Liste Abscences</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <a href="{{route('abscence.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Une Abscence</a>
        </div>
        <div class="row">
            <form action="{{route('abscence.index')}}" method="GET">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-university fa-lg"></i>
                        <h2>Recherche <small>Critere de recherche</small></h2>
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px;">
                            <div class="col-sm-4">
                                <label for="annee_id" class="control-label">Année</label>
                                <select  id="annee_id" name="annee_id" class="form-control">
                                    <option value="" selected disabled>Selectionnez Année</option>
                                    @foreach($annees as $annee)
                                        <option value="{{$annee->id}}">{{$annee->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="classe_id" class="control-label">Classe</label>
                                <select  id="classe_id" name="classe_id" class="form-control">
                                    <option value="" selected disabled>Selectionnez Classe</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="matiere_id" class="control-label">Matiere</label>
                                <select id="matiere_id" name="matiere_id" class="form-control">
                                    <option value="" selected disabled>Selectionner Matiere</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="semestre_id" class="control-label">Semestre</label>
                                <select id="semestre_id" name="semestre_id" class="form-control">
                                    <option value="" selected disabled>Selectionner Semestre</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="date_pub" class="control-label">Date</label>
                                <div class="form-group">
                                    <input name="date" id="date_pub" class="validate" type="date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-labeled btn-success">
                                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Recherche
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            @if($abscences->count() != 0)
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table fa-lg"></i>
                        Liste des Abscences
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table id="abscencesTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Etudiant</th>
                                    <th>Matiere</th>
                                    <th>Seance</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($abscences as $abscence)
                                    <tr>
                                        <td>
                                            {{date('d-m-Y', strtotime($abscence->date))}}
                                        </td>
                                        <td>
                                            {{$abscence->user->nom}} {{$abscence->user->prenom}}
                                        </td>
                                        <td>
                                            {{$abscence->matiere->nom}}
                                        </td>
                                        <td>
                                            {{date('H:i', strtotime($abscence->seance->heure_debut))}} => {{date('H:i', strtotime($abscence->seance->heure_fin))}}
                                        </td>
                                        <td>
                                            <button onclick="deleteAbscence('{{$abscence->id}}','{{$abscence->user->nom}} {{$abscence->user->prenom}}')" type="button" class="btn btn-danger w-md">Supp</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning z-depth-1">
                    <strong>Oops!</strong> Aucune Abscence Trouvé.
                </div>
            @endif
        </div>
        <!-- ./cotainer -->
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content panel-warning">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <form action="#" method="post" id="deleteform">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <input type="submit" class="btn btn-success" value="Oui, Supprimer" />
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('scriptpage')
    <!-- dataTables js -->
    <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function (iziToast) {
            $('#abscencesTable').DataTable();
            @if ($message = \Illuminate\Support\Facades\Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
        });
        function deleteAbscence(id,nom) {
            $('#deleteform').attr('action','{{route('abscence.destroy')}}'+'/'+id);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer labscence de l\'etudiant :'+nom+'</h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
