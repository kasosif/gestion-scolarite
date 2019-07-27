@extends('layouts.app')
@section('title')
    Liste des Formations
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('formationactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Formations</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('formation.index')}}">Liste des Formations</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        {{--@can('create',\App\Model\Annee::class)--}}
        <div class="row">
            <a href="{{route('formation.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Formation</a>
        </div>
        {{--@endcan--}}
        <div class="row">
            @if($formations->count() != 0)
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table fa-lg"></i>
                        Liste des Formations
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table id="formationsTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Niveau</th>
                                    <th>Propriétaire</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($formations as $formation)
                                    <tr>
                                        <td>
                                            @if($formation->image)
                                                <img
                                                    src="{{asset('images/formations/'.$formation->image)}}"
                                                    alt="formation Image" style="width: 50px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            {{$formation->titre}}
                                        </td>
                                        <td>
                                            {{$formation->niveau->nom}}
                                        </td>
                                        <td>
                                            {{$formation->user->gendre == 'male' ? 'Mr.' : 'Mme.' }}{{$formation->user->prenom}} {{$formation->user->nom}}
                                        </td>
                                        <td>
                                            {{--@can('update',$annee)--}}
                                            <a href="{{route('formation.edit',['id' => $formation->id])}}" class="btn btn-primary w-md">Modif/Info</a>
                                            {{--@endcan--}}
                                            {{--@can('delete',$annee)--}}
                                            <button onclick="deleteRessource('{{$formation->id}}','{{$formation->titre}}')" type="button" class="btn btn-danger w-md">Supp</button>
                                            {{--@endcan--}}
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
                    <strong>Oops!</strong> Aucune Formation Trouvé.
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
            $('#formationsTable').DataTable();
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
        });
        function deleteRessource(id,nom) {
            $('#deleteform').attr('action','{{route('formation.destroy')}}'+'/'+id);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer la formation:'+nom+'</h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
