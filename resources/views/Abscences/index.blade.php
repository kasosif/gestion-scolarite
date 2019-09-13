@extends('layouts.app')
@section('title')
    @if(\Request::route()->getName() == 'abscencesetudiant.index')
        Liste des Abscences Des Etudiants
    @else
        Liste des Abscences Des Professeurs
    @endif
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}" rel="stylesheet" type="text/css" />

    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />


    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('abscenceetudiantactive')
    @if(\Request::route()->getName() == 'abscencesetudiant.index')
        class = "active-link"
    @endif
@endsection
@section('etudiantactive')
    @if(\Request::route()->getName() == 'abscencesetudiant.index')
        class = "active"
    @endif
@endsection

@section('abscenceprofesseuractive')
    @if(\Request::route()->getName() == 'abscencesprofesseur.index')
        class = "active-link"
    @endif
@endsection
@section('professeuractive')
    @if(\Request::route()->getName() == 'abscencesprofesseur.index')
        class = "active"
    @endif
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> @if(\Request::route()->getName() == 'abscencesetudiant.index')
                    Liste des Abscences Des Etudiants
                @else
                    Liste des Abscences Des Professeurs
                @endif</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li>
                    @if(\Request::route()->getName() == 'abscencesetudiant.index')
                        <a href="{{route('abscencesetudiant.index')}}">Liste Abscences Etudiants</a>
                    @else
                        <a href="{{route('abscencesprofesseur.index')}}">Liste Abscences Professeurs</a>
                    @endif

                </li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        @can('createEtudiant',\App\Model\Abscence::class)
            @if(\Request::route()->getName() == 'abscencesetudiant.index')
                <div class="row">
                    <a href="{{route('abscencesetudiant.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Une Abscence</a>
                </div>
            @endif
        @endcan
        @can('createProfesseur',\App\Model\Abscence::class)
            @if(\Request::route()->getName() == 'abscencesprofesseur.index')
                <div class="row">
                    <a href="{{route('abscencesprofesseur.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Une Abscence</a>
                </div>
            @endif
        @endcan
        @if(\Request::route()->getName() == 'abscencesetudiant.index')
            <div class="row">
                <form action="{{route('abscencesetudiant.index')}}" method="GET">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-university fa-lg"></i>
                            <h2>Recherche <small>Critere de recherche</small></h2>
                        </div>
                        <div class="card-body">
                            <div class="row" style="padding: 4px;">
                                <div class="col-sm-4">
                                    <label for="spec_id" class="control-label">Specialité</label>
                                    <select required id="spec_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Specialité</option>
                                        @foreach($annees as $annee)
                                            <optgroup label="{{$annee->nom}}">
                                                @foreach($annee->specialites as $spec)
                                                    <option value="{{$spec->id}}">{{$spec->nom}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="classe_id" class="control-label">Classe</label>
                                    <select required  id="classe_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Classe</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label  for="user_id" class="control-label">Etudiant</label>
                                    <select required id="user_id" name="user_id" class="form-control">
                                        <option value="" selected disabled>Selectionner Etudiant</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="date_pub" class="control-label">Date</label>
                                    <div class="form-group">
                                        <input name="date" id="date_pub" class="validate" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn btn-labeled btn-success">
                                    <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Recherche
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
        <div class="row">
            @if($abscences)
                @if($abscences->count() != 0)
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-table fa-lg"></i>
                            @if(\Request::route()->getName() == 'abscencesetudiant.index')
                                Liste Abscences Etudiants
                            @else
                                Liste Abscences Professeurs
                            @endif
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table id="abscencesTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Classe</th>
                                        @if(\Request::route()->getName() == 'abscencesetudiant.index')
                                            <th>Etudiant</th>
                                        @else
                                            <th>Professeur</th>
                                        @endif

                                        <th>Matiere</th>
                                        <th>Seance</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($abscences as $abscence)
                                        <tr>
                                            @if(\Request::route()->getName() == 'abscencesetudiant.index')
                                                <td>
                                                    {{$abscence->user->classe->niveau->specialite->nom}} {{$abscence->user->classe->abbreviation}} {{$abscence->user->classe->niveau->nom}}
                                                </td>
                                            @else
                                                <td>
                                                    {{$abscence->classe->niveau->specialite->nom}} {{$abscence->classe->abbreviation}} {{$abscence->classe->niveau->nom}}
                                                </td>
                                            @endif
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
                                                {{date('d-m-Y', strtotime($abscence->date))}}
                                            </td>
                                            <td>
                                                @can('createEtudiant',\App\Model\Abscence::class)
                                                    @if(\Request::route()->getName() == 'abscencesetudiant.index')
                                                        <a href="{{route('abscencesetudiant.edit',['id' => $abscence->id])}}" type="button" class="btn btn-primary w-md">Modif</a>
                                                    @endif
                                                @endcan
                                                @can('createProfesseur',\App\Model\Abscence::class)
                                                    @if(\Request::route()->getName() == 'abscencesprofesseur.index')
                                                        <a href="{{route('abscencesprofesseur.edit',['id' => $abscence->id])}}" type="button" class="btn btn-primary w-md">Modif</a>
                                                    @endif
                                                @endcan
                                                @can('deleteEtudiant',$abscence)
                                                    @if(\Request::route()->getName() == 'abscencesetudiant.index')
                                                        <button onclick="deleteAbscenceEtudiant('{{$abscence->id}}','{{$abscence->user->nom}} {{$abscence->user->prenom}}')" type="button" class="btn btn-danger w-md">Supp</button>
                                                    @endif
                                                @endcan
                                                @can('deleteProfesseur',$abscence)
                                                    @if(\Request::route()->getName() == 'abscencesprofesseur.index')
                                                        <button onclick="deleteAbscenceProfesseur('{{$abscence->id}}','{{$abscence->user->nom}} {{$abscence->user->prenom}}')" type="button" class="btn btn-danger w-md">Supp</button>
                                                    @endif
                                                @endcan
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
            @else
                <div class="alert alert-warning z-depth-1">
                    <strong>Chrecher l'etudiant </strong>
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
                    @if(\Request::route()->getName() == 'abscencesetudiant.index')
                        <form action="#" method="post" id="deleteEtudiantform">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <input type="submit" class="btn btn-success" value="Oui, Supprimer" />
                        </form>
                    @endif
                    @if(\Request::route()->getName() == 'abscencesprofesseur.index')
                        <form action="#" method="post" id="deleteProfesseurform">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <input type="submit" class="btn btn-success" value="Oui, Supprimer" />
                        </form>
                    @endif
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('scriptpage')
    <!-- dataTables js -->
    <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('select').select2();
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
            $('#abscencesTable').DataTable();
            @if(\Request::route()->getName() == 'abscencesetudiant.index')
            $('body').on('change','#spec_id',function () {
                $.ajax({
                    url: '{{route('ajax.classesbyspec')}}'+'/'+ $('#spec_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#classe_id").html(response);
                        $("#user_id").html('');
                    }
                });
            });
            $('body').on('change','#classe_id',function () {
                $.ajax({
                    url: '{{route('ajax.studentsbyclass')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#user_id").html(response);
                    }
                });
            });
            @endif
        });
        @if(\Request::route()->getName() == 'abscencesetudiant.index')
        function deleteAbscenceEtudiant(id,nom) {
            $('#deleteEtudiantform').attr('action','{{route('abscencesetudiant.destroy')}}'+'/'+id);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer labscence de l\'etudiant :'+nom+'</h2>');
            $('#deleteModal').modal('show');
        }
        @endif
        @if(\Request::route()->getName() == 'abscencesprofesseur.index')
        function deleteAbscenceProfesseur(id,nom) {
            $('#deleteProfesseurform').attr('action','{{route('abscencesprofesseur.destroy')}}'+'/'+id);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer labscence du professeur :'+nom+'</h2>');
            $('#deleteModal').modal('show');
        }
        @endif
    </script>
@endsection
