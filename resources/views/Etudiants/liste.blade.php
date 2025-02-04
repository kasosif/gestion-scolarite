@extends('layouts.app')
@section('title')
    Liste des Etudiants
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('etudiantactive')
    class = "active"
@endsection
@section('listeetudiantactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Etudiants</h1>
            <small> Liste des etudiants</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('etudiant.index')}}">Liste Etudiants</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        @can('createEtudiant',\App\Model\User::class)
            <div class="row">
                <a href="{{route('etudiant.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Etudiant</a>
            </div>
        @endcan
        <div class="row">
            @if($etudiants->count() != 0)
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table fa-lg"></i>
                        Liste des Etudiants
                        <div style="float: right">
                            <a href="{{route('abscencesetudiant.index')}}" class="btn btn-primary">Liste Abscenses </a>
                            <a href="{{route('note.index')}}" class="btn btn-primary">Notes Etudiant</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table id="etudiantsTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Classe</th>
                                    <th>Image</th>
                                    <th>CIN</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Gendre</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($etudiants as $etudiant)
                                    <tr>
                                        <td>
                                            {{$etudiant->classe->abbreviation}} {{$etudiant->classe->niveau->specialite->nom}} {{$etudiant->classe->niveau->nom}}
                                        </td>
                                        <td>
                                            <img @if($etudiant->image)
                                                 src="{{asset('images/etudiants/'.$etudiant->image)}}"
                                                 @elseif($etudiant->gendre == 'female')
                                                 src="{{asset('assets/dist/img/avatar2.png')}}"
                                                 @elseif($etudiant->gendre == 'male')
                                                 src="{{asset('assets/dist/img/avatar5.png')}}"
                                                 @endif
                                                alt="User Image" style="width: 50px;">
                                        </td>
                                        <td>
                                            {{$etudiant->cin}}
                                        </td>
                                        <td>
                                            {{$etudiant->prenom}}
                                        </td>
                                        <td>
                                            {{$etudiant->nom}}
                                        </td>
                                        <td>
                                            {{$etudiant->gendre  === "male" ? "Homme" : "Femme"}}
                                        </td>
                                        <td>
                                            @can('updateEtudiant',$etudiant)
                                                <a href="{{route('etudiant.edit',['cin' => $etudiant->cin])}}" class="btn btn-primary w-md">Modif</a>
                                            @endcan
                                            @can('viewEtudiant',$etudiant)
                                                <a href="{{route('etudiant.show',['cin' => $etudiant->cin])}}" class="btn btn-warning w-md">Info/Docs</a>
                                            @endcan
                                            @can('deleteEtudiant',\App\Model\User::class)
                                                <button onclick="deleteUser('{{$etudiant->cin}}')" type="button" class="btn btn-danger w-md">Supp</button>
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
                    <strong>Oops!</strong> Aucun Etudiant Trouvé.
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
        $(document).ready(function () {
            $('.table').DataTable();
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
        });
        function deleteUser(cin) {
            $('#deleteform').attr('action','{{route('etudiant.destroy')}}'+'/'+cin);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer l\'etudiant muni du CIN :'+cin+'</h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
