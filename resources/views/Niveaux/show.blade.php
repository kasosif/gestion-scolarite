@extends('layouts.app')
@section('title')
    Information Sur Niveau "{{$niveau->nom}}"
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('basesactive')
    class = "active"
@endsection
@section('niveauactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Niveau "{{$niveau->nom}}"</h1>
            <small>Interface d'information de niveau</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('niveau.index')}}">Liste Niveaux</a></li>
                <li>Niveau "{{$niveau->nom}}"</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('niveau.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Info Niveau
                </div>
                <div class="card-content">
                    <div class="row">
                        <ul>
                            <li>Annee Scolaire : {{$niveau->specialite->annee->nom}}</li>
                            <li>Specialite : {{$niveau->specialite->nom}}</li>
                            <li>Nom : {{$niveau->nom}}</li>
                        </ul>
                    </div>
                    @if($niveau->matieres()->count() > 0)
                        <div class="row">
                            <h2>Mes Matieres</h2>
                            <div class="table-responsive">
                                <table id="matieresTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Coeficient</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($niveau->matieres as $matiere)
                                        <tr>
                                            <td>
                                                {{$matiere->nom}}
                                            </td>
                                            <td>
                                                {{$matiere->coeficient}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if($niveau->classes()->count() > 0)
                        <div class="row">
                            <h2>Mes Classes</h2>
                            <div class="table-responsive">
                                <table id="classesTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Abbreviation</th>
                                        <th>Code</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($niveau->classes as $classe)
                                        <tr>
                                            <td>
                                                {{$classe->abbreviation}}
                                            </td>
                                            <td>
                                                {{$classe->code}}
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
    <!-- dataTables js -->
    <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
@endsection
