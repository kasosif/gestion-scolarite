@extends('layouts.app')
@section('title')
    Modifier la note d'un Etudiant
@endsection
@section('preloader')
@endsection
@section('csspage') @endsection
@section('noteetudiantactive')
    class = "active-link"
@endsection
@section('etudiantactive')
    class = "active"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Modifier la note d'un Etudiant </h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li>
                    <a href="{{route('note.index')}}">Liste Notes Etudiants</a>
                </li>
                <li>
                    Modifier Note
                </li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('note.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <form action="{{route('note.update',['id'=> $note->id])}}" method="post">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="etudiantsTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Note</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        @if($note->user->image)
                                            <img src="{{asset('images/etudiants/'.$note->user->image)}}" alt="User Image" style="width: 50px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        {{$note->user->prenom}}
                                    </td>
                                    <td>
                                        {{$note->user->nom}}
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label>
                                                <input class="form-control" value="{{$note->mark}}" placeholder="?/20"  step="0.01" type="number" name="mark" min="0" max="20">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pull-right" style="margin-top: 14px">
                            <button type="submit" class="btn btn-labeled btn-success">
                                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Modifier
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </form>
        </div>
        <!-- ./cotainer -->
    </div>
@endsection
@section('scriptpage')
@endsection
