@extends('layouts.app')
@section('title')
    Liste des Emplois de la Classe {{$classe->niveau->specialite->nom }} {{$classe->abbreviation}} {{$classe->niveau->nom}}
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('emploisactive')
    class = "active"
@endsection
@section('emploislisteactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Emplois</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('emplois.classes')}}">Liste Emplois Par Classes</a></li>
                <li><a href="{{route('emplois.classe',['classe_id'=>$classe->id])}}">Liste Emplois Classe</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('emplois.classes')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            @if($emplois->count() != 0)
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-table fa-lg"></i>
                            Liste des Emplois de la classe : {{$classe->niveau->specialite->nom }} {{$classe->abbreviation}} {{$classe->niveau->nom}}
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Semaine</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($emplois as $emploi)
                                            <tr>
                                                <td>
                                                    {{$emploi->semaine}} (de {{date('d-m-Y', strtotime($emploi->date_debut))}} à {{date('d-m-Y', strtotime($emploi->date_fin))}})
                                                </td>
                                                <td>
                                                    <a href="{{route('emplois.edit',['classe_id'=>$classe->id,'dateD'=>$emploi->date_debut])}}" class="btn btn-primary w-md">Modifier</a>
                                                    <a target="_blank" href="{{route('emplois.show',['classe_id'=>$classe->id,'dateD'=>$emploi->date_debut])}}" class="btn btn-info w-md">Voir</a>
                                                    <button onclick="deleteResource('{{$classe->id}}','{{$emploi->date_debut}}','{{$emploi->date_fin}}')" type="button" class="btn btn-danger w-md">Supp</button>
                                                    <a href="{{route('emplois.printweek',['classe_id'=>$classe->id,'dateD'=>$emploi->date_debut])}}" class="btn btn-yellow w-md">Imprimer</a>
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
                    <strong>Oops!</strong> Aucun emploi trouvé
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
            @if ($message = Session::get('erreur'))
            iziToast.error({
                title: 'Erreur',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
        });
        function deleteResource(classe,dateD,dateF) {
            $('#deleteform').attr('action','{{route('emplois.destroy')}}'+'/'+classe+'/'+dateD);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer l\'emploi de la semaine :'+dateD+' => '+dateF+' </h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
