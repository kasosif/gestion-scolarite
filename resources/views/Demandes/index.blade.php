@extends('layouts.app')
@section('title')
    Liste des Demandes
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('demandeactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Demandes</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('demande.index')}}">Liste des Demandes</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            @if($demandes->count() != 0)
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table fa-lg"></i>
                        Liste des Demandes d'attestation
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table id="demandesTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Date Demande</th>
                                    <th>Type</th>
                                    <th>Etudiant</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($demandes as $demande)
                                    <tr>
                                        <td>
                                            {{$demande->created_at}}
                                        </td>
                                        <td>
                                            @if($demande->type == 'Presence')
                                                Attestation de Presence
                                            @elseif($demande->type == 'Inscription')
                                                Attestation d'Inscription
                                            @else
                                                <p>{{$demande->description}}</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a target="_blank" href="{{route('etudiant.show',['cin'=> $demande->user->cin])}}">
                                                {{$demande->user->prenom}} {{$demande->user->nom}}
                                            </a>
                                        </td>
                                        <td>
                                            @can('update',$demande)
                                                <button onclick="treatRessource('{{$demande->user->cin}}', '{{$demande->type}}', '{{$demande->id}}')" type="button" class="btn btn-success w-md">Traiter</button>
                                            @endcan
                                            @can('delete',$demande)
                                                <button onclick="deleteRessource('{{$demande->user->cin}}', '{{$demande->type}}', '{{$demande->id}}')" type="button" class="btn btn-danger w-md">Supp</button>
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
                    <strong>Oops!</strong> Aucune Demande Trouvé.
                </div>
            @endif
        </div>
        <!-- ./cotainer -->
    </div>
    <div class="modal fade" id="treatModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content panel-warning">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation de Traitement</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <form action="#" method="post" id="treatform">
                        {{method_field('patch')}}
                        @csrf
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <input type="submit" class="btn btn-success" value="Oui, Traiter" />
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content panel-warning">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmation de Suppression</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <form action="#" method="post" id="deleteform">
                        {{method_field('delete')}}
                        @csrf
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <input type="submit" class="btn btn-danger" value="Oui, Supprimer" />
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
            $('#demandesTable').DataTable();
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
        });
        function treatRessource(cin, type, id) {
            $('#treatform').attr('action','{{route('demande.treat')}}'+'/'+id);
            $('.modal-body').html('<h2>Vous avez génerer la demande d\'attestation "'+type+'" de l\'etudiant ayant le cin : "'+cin+'" ? </h2>');
            $('#treatModal').modal('show');
        }
        function deleteRessource(cin, type, id) {
            $('#deleteform').attr('action','{{route('demande.destroy')}}'+'/'+id);
            $('.modal-body').html('<h2>Etes vous sur de supprimer la demande d\'attestation "'+type+'" de l\'etudiant ayant le cin : "'+cin+'" ? </h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
