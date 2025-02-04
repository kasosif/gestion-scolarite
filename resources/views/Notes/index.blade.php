@extends('layouts.app')
@section('title')
    Liste des Notes
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
@section('etudiantactive')
    class = "active"
@endsection
@section('noteetudiantactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Notes</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('note.index')}}">Liste Notes</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        @can('create',\App\Model\Note::class)
            <div class="row">
                <a href="{{route('note.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Note</a>
            </div>
        @endcan
        <div class="row">
            <form action="{{route('note.index')}}" method="GET">
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
        <div class="row">
            @if($notes)
                @if($notes->count() != 0)
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-table fa-lg"></i>
                            Liste des Notes
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table id="notesTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Etudiant</th>
                                        <th>Matiere</th>
                                        <th>Devoir</th>
                                        <th>Note</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($notes as $note)
                                        <tr>
                                            <td>
                                                <img @if($note->user->image)
                                                     src="{{asset('images/etudiants/'.$note->user->image)}}"
                                                     @elseif($note->user->gendre == 'female')
                                                     src="{{asset('assets/dist/img/avatar2.png')}}"
                                                     @elseif($note->user->gendre == 'male')
                                                     src="{{asset('assets/dist/img/avatar5.png')}}"
                                                     @endif
                                                     alt="User Image" style="width: 50px;">
                                            </td>
                                            <td>
                                                {{$note->user->nom}} {{$note->user->prenom}}
                                            </td>
                                            <td>
                                                {{$note->devoir->matiere->nom}}
                                            </td>
                                            <td>
                                                {{$note->devoir->nom}} {{strtoupper($note->devoir->type)}}
                                            </td>
                                            <td>
                                                {{$note->mark}}
                                            </td>
                                            <td>
                                                @can('update',$note)
                                                    <a href="{{route('note.edit',['id' => $note->id])}}" class="btn btn-primary w-md">Modif</a>
                                                @endcan
                                                @can('delete',$note)
                                                    <button onclick="deleteRessource('{{$note->id}}','{{$note->nom}}')" type="button" class="btn btn-danger w-md">Supp</button>
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
                        <strong>Oops!</strong> Aucune Note Trouvé.
                    </div>
                @endif
            @else
                <div class="alert alert-warning z-depth-1">
                    <strong>Rechcercher Etudiant</strong>
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
    <!-- Select2 -->
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
    <!-- dataTables js -->
    <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('select').select2();
            $('#notesTable').DataTable();
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
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
        });
        function deleteRessource(id,nom) {
            $('#deleteform').attr('action','{{route('note.destroy')}}'+'/'+id);
            $('.modal-body').html('<h2>Etes-vous sûr de vouloir supprimer la note:'+nom+'</h2>');
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
