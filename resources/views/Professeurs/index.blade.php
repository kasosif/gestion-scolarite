@extends('layouts.app')
@section('title')
    Liste des Professeurs
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('professeuractive')
    class = "active"
@endsection
@section('listeprofesseuractive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Professeurs</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('professeur.index')}}">Liste Professeurs</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        @can('createProfesseur', \App\Model\User::class)
            <div class="row">
                <a href="{{route('professeur.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Professeur</a>
            </div>
        @endcan
        <div class="row">
            @if($professeurs->count() != 0)
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table fa-lg"></i>
                        Liste des Professeurs
                        <div style="float: right"><a href="{{route('abscencesprofesseur.index')}}" class="btn btn-primary">Liste Abscences </a></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table id="professeursTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>CIN</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Gendre</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($professeurs as $professeur)
                                    <tr>
                                        <td>
                                            <img @if($professeur->image)
                                                 src="{{asset('images/professeurs/'.$professeur->image)}}"
                                                 @elseif($professeur->gendre == 'female')
                                                 src="{{asset('assets/dist/img/avatar2.png')}}"
                                                 @elseif($professeur->gendre == 'male')
                                                 src="{{asset('assets/dist/img/avatar5.png')}}"
                                                 @endif
                                                 alt="User Image" style="width: 50px;">
                                        </td>
                                        <td>
                                            {{$professeur->cin}}
                                        </td>
                                        <td>
                                            {{$professeur->prenom}}
                                        </td>
                                        <td>
                                            {{$professeur->nom}}
                                        </td>
                                        <td>
                                            {{$professeur->gendre  === "male" ? "Homme" : "Femme"}}
                                        </td>
                                        <td>
                                            @can('updateProfesseur',$professeur)
                                                <a href="{{route('professeur.edit',['cin' => $professeur->cin])}}" class="btn btn-primary w-md">Modif/Info</a>
                                            @endcan
                                            @can('deleteProfesseur',$professeur)
                                                <button onclick="deleteUser('{{$professeur->cin}}')" type="button" class="btn btn-danger w-md">Supp</button>
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
                    <strong>Oops!</strong> Aucun Professeur Trouvé.
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
            $('#professeursTable').DataTable();
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
        });
        function deleteUser(cin) {
            $('#deleteform').attr('action','{{route('professeur.destroy')}}'+'/'+cin);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer le Professeur muni du CIN :'+cin+'</h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
