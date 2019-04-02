@extends('layouts.app')
@section('title')
    Information Sur Classe "{{$classe->abbreviation}}"
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('parametreactive')
    class = "active"
@endsection
@section('classeactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> {{$classe->abbreviation}}</h1>
            <small>Interface d'information de classe</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('classe.index')}}">Liste Classes</a></li>
                <li>{{$classe->abbreviation}}</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('classe.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Info Classe
                </div>
                <div class="card-content">
                    <div class="row">
                        <ul>
                            <li>Abbreviation : {{$classe->abbreviation}}</li>
                            <li>Code : {{$classe->code}}</li>
                            <li>Promotion : {{$classe->promotion}}</li>
                            <li>Specialité : {{$classe->specialite != null ? $classe->specialite->nom : 'pas de specialite'}}</li></li>
                            <li>Année Scolaire : {{$classe->annee != null ? $classe->annee->nom : 'pas d\'année'}}</li>
                        </ul>
                    </div>
                    @if($classe->users()->count() > 0)
                        <div class="row">
                            <h2>Mes Etudiants</h2>
                            <div class="table-responsive">
                                <table id="etudiantTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classe->users as $etudiant)
                                        <tr>
                                            <td>
                                                {{$etudiant->nom}}
                                            </td>
                                            <td>
                                                {{$etudiant->prenom}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if($classe->matieres()->count() > 0)
                        <div class="row">
                            <h2>Mes Matiéres</h2>
                            <div class="table-responsive">
                                <table id="matieresTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Coeficient</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classe->matieres as $matiere)
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
        @if($classe->matieres()->count() > 0)
            $('#matieresTable').DataTable();
        @endif
        @if($classe->users()->count() > 0)
            $('#etudiantTable').DataTable();
        @endif
        });
    </script>

@endsection
