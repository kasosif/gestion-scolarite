@extends('layouts.app')
@section('title')
    Liste des Années Scolaires
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('basesactive')
    class = "active"
@endsection
@section('anneeactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Années Scolaires</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('annee.index')}}">Liste Années Scolaires</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        @can('create',\App\Model\Annee::class)
        <div class="row">
            <a href="{{route('annee.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Année Scolaire</a>
        </div>
        @endcan
        <div class="row">
            @if($annees->count() != 0)
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table fa-lg"></i>
                        Liste des Années Scolaires

                        <div style="float: right"><a href="{{route('specialite.ajout')}}" class="btn btn-primary">Ajouter Spécialité</a></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table id="professeursTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Date Debut</th>
                                    <th>Date Fin</th>
                                    <th>Code</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($annees as $annee)
                                    <tr>
                                        <td>
                                            {{$annee->nom}}
                                        </td>
                                        <td>
                                            {{$annee->date_debut}}
                                        </td>
                                        <td>
                                            {{$annee->date_fin}}
                                        </td>
                                        <td>
                                            {{$annee->code}}
                                        </td>
                                        <td>
                                            @can('update',$annee)
                                                <a href="{{route('annee.edit',['id' => $annee->id])}}" class="btn btn-primary w-md">Modif</a>
                                            @endcan
                                            @can('view',$annee)
                                                <a href="{{route('annee.show',['id' => $annee->id])}}" class="btn btn-warning w-md">Info</a>
                                            @endcan
                                            @can('delete',$annee)
                                                <button onclick="deleteRessource('{{$annee->id}}','{{$annee->nom}}')" type="button" class="btn btn-danger w-md">Supp</button>
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
                    <strong>Oops!</strong> Aucune Année Scolaire Trouvé.
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
        function deleteRessource(id,nom) {
            $('#deleteform').attr('action','{{route('annee.destroy')}}'+'/'+id);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer l\'annee scolaire:'+nom+'</h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
