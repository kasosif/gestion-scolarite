@extends('layouts.app')
@section('title')
    Liste des Devoirs
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('devoiractive')
    class = "active-link"
@endsection
@section('parametreactive')
    class = "active"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Devoirs</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('devoir.index')}}">Liste Devoirs</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        @can('create', \App\Model\Devoir::class)
            <div class="row">
                <a href="{{route('devoir.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Un Devoir</a>
            </div>
        @endcan
        <div class="row">
            @if($devoirs->count() != 0)
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table fa-lg"></i>
                        Liste des Devoirs
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table id="devoirsTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Classe</th>
                                    <th>Matiere</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($devoirs as $devoir)
                                    <tr>
                                        <td>
                                            {{$devoir->classe->abbreviation}} {{$devoir->classe->niveau->nom}}
                                        </td>
                                        <td>
                                            {{$devoir->matiere->nom}}
                                        </td>
                                        <td>
                                            {{$devoir->date}}
                                        </td>
                                        <td>
                                            @can('update', $devoir)
                                                <a href="{{route('devoir.edit',['id' => $devoir->id])}}" class="btn btn-primary w-md">Modif/Info</a>
                                            @endcan
                                            @can('delete', $devoir)
                                                <button onclick="deleteDevoir('{{$devoir->id}}','{{$devoir->nom}}')" type="button" class="btn btn-danger w-md">Supp</button>
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
                    <strong>Oops!</strong> Aucun Devoir Trouvé.
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
            $('#devoirsTable').DataTable();
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
        });
        function deleteDevoir(id,titre) {
            $('#deleteform').attr('action','{{route('devoir.destroy')}}'+'/'+id);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer le devoir :'+titre+'</h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
