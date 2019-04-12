@extends('layouts.app')
@section('title')
    Information Sur Matiere "{{$matiere->nom}}"
@endsection
@section('preloader')
@endsection
@section('csspage')
    @if($matiere->devoirs()->count() > 0)
        <!-- dataTables css -->
        <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
@endsection
@section('parametreactive')
    class = "active"
@endsection
@section('matiereactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> {{$matiere->nom}}</h1>
            <small>Interface d'information de matiere</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('matiere.index')}}">Liste Matieres</a></li>
                <li>{{$matiere->nom}}</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('matiere.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Info Matiere
                </div>
                <div class="card-content">
                    <div class="row">
                        <ul>
                            <li>Nom : {{$matiere->nom}}</li>
                            <li>Coeficcient : {{$matiere->coeficient}}</li>
                            <li>Nombre d'heures : {{$matiere->nbr_heures}}</li>
                            <li>Plafond Abscences : {{$matiere->plafond_abscences}}</li>
                            <li>Horraires : {{$matiere->horaires}}</li>
                            <li>Ma Specialite : <b>{{$matiere->niveau->specialite->nom}}</b></li>
                            <li>Mon Niveau : <b>{{$matiere->niveau->nom}}</b></li>
                        </ul>
                    </div>
                    @if($matiere->devoirs()->count() > 0)
                        <div class="row">
                            <h2>Mes Devoirs</h2>
                            <div class="table-responsive">
                                <table id="devoirsTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Coeficient</th>
                                        <th>Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($matiere->devoirs as $devoir)
                                        <tr>
                                            <td>
                                                {{$devoir->nom}}
                                            </td>
                                            <td>
                                                {{$devoir->coeficient}}
                                            </td>
                                            <td>
                                                {{$devoir->type}}
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
    @if($matiere->devoirs()->count() > 0)
        <!-- dataTables js -->
        <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#devoirsTable').DataTable();
            });
        </script>
    @endif
@endsection
