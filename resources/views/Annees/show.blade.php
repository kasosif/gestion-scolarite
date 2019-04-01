@extends('layouts.app')
@section('title')
    Information Sur Annnée Scolaire "{{$annee->code}}"
@endsection
@section('preloader')
@endsection
@section('csspage')
    @if($annee->classes()->count() > 0)
        <!-- dataTables css -->
        <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
@endsection
@section('parametreactive')
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
            <h1> Annnée Scolaire "{{$annee->code}}"</h1>
            <small>Interface d'information d'année scolaire</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('annee.index')}}">Liste Années Scolaires</a></li>
                <li>Annnée Scolaire "{{$annee->code}}"</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('annee.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Info Année Scolaire
                </div>
                <div class="card-content">
                    <div class="row">
                        <ul>
                            <li>Nom : {{$annee->nom}}</li>
                            <li>Nom Arabe : {{$annee->nom_ar === null ? 'pas de nom' : $annee->nom_ar}}</li>
                            <li>Date Debut : {{$annee->date_debut}}</li>
                            <li>Date Fin : {{$annee->date_fin}}</li>
                            <li>Code : {{$annee->code}}</li>
                        </ul>
                    </div>
                    @if($annee->classes()->count() > 0)
                        <div class="row">
                            <h2>Mes Classes</h2>
                            <div class="table-responsive">
                                <table id="classesTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Abbreviation</th>
                                        <th>Promotion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($annee->classes as $classe)
                                        <tr>
                                            <td>
                                                {{$classe->code}}
                                            </td>
                                            <td>
                                                {{$classe->abbreviation}}
                                            </td>
                                            <td>
                                                {{$classe->promotion}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- ./cotainer -->
    </div>
@endsection
@section('scriptpage')
    @if($annee->classes()->count() > 0)
        <!-- dataTables js -->
        <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#classesTable').DataTable();
            });
        </script>
    @endif
@endsection
