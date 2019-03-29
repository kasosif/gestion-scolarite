@extends('layouts.app')
@section('title')
    Liste des Etudiants
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
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
            <small> Liste des etudiants par annee scolaire {{$annee->nom}}</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('etudiant.liste',['id' => $annee->id])}}">Liste Etudiants</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <a href="{{route('etudiant.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Etudiant</a>
            <div class="pull-right">
                <a href="{{route('etudiant.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="panel-group" id="accordion" role="tablist">
                @forelse($annee->classes as $indexKey => $classe)
                    <div class="panel panel-default">
                        <div class="panel-heading panel-acc" role="tab" id="heading{{$indexKey}}">
                            <h4 class="panel-title">
                                <a style="color: black" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$indexKey}}" aria-controls="collapse{{$indexKey}}">
                                    <i class="fa fa-plus" style="color: black"></i>
                                    @if($classe->code) Code Classe :  {{$classe->code}} ,@endif
                                    @if($classe->abbreviation) Abbreviation Classe :  {{$classe->abbreviation}} ,@endif
                                    @if($classe->promotion) Promotion :  {{$classe->promotion}} ,@endif
                                    @if($classe->maspecialite) Specialite :  {{$classe->maspecialite->nom}} @endif
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{$indexKey}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$indexKey}}">
                            @if($classe->users()->count() != 0)
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>CIN</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Gendre</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($classe->users as $etudiant)
                                                @if($etudiant->role == "ROLE_ETUDIANT")
                                                    <tr>
                                                        <td>
                                                            @if($etudiant->image)
                                                                <img src="{{asset('images/etudiants/'.$etudiant->image)}}" alt="User Image" style="width: 50px;">
                                                            @else
                                                                No Image
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{$etudiant->cin}}
                                                        </td>
                                                        <td>
                                                            {{$etudiant->nom}}
                                                        </td>
                                                        <td>
                                                            {{$etudiant->prenom}}
                                                        </td>
                                                        <td>
                                                            {{$etudiant->gendre  === "male" ? "Homme" : "Femme"}}
                                                        </td>
                                                        <td>
                                                            <a href="{{route('etudiant.edit',['cin' => $etudiant->cin])}}" class="btn btn-primary w-md">Modif/Info</a>
                                                            <button type="button" class="btn btn-warning w-md">Docs</button>
                                                            <button onclick="deleteUser({{$etudiant->cin}})" type="button" class="btn btn-danger w-md">Supp</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning z-depth-1">
                                    <strong>Oops!</strong> Aucun Etudiant Trouvé.
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning z-depth-1">
                        <strong>Oops!</strong> Aucune Classe Trouvée.
                    </div>
                @endforelse
            </div>
            <!-- ./Data tables -->
            <!-- ./row -->
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
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
        function deleteUser(cin) {
            $('#deleteform').attr('action','{{route('etudiant.destroy')}}'+'/'+cin);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer l\'etudiant muni du CIN :'+cin+'</h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
