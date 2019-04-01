@extends('layouts.app')
@section('title')
    Information Sur Semestre "{{$semestre->nom}}"
@endsection
@section('preloader')
@endsection
@section('csspage')
    @if($semestre->matieres()->count() > 0)
        <!-- dataTables css -->
        <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
@endsection
@section('parametreactive')
    class = "active"
@endsection
@section('semestreactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> {{$semestre->nom}}</h1>
            <small>Interface d'information de semestre</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('semestre.index')}}">Liste Semestres</a></li>
                <li>{{$semestre->nom}}</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('semestre.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Info Semestre
                </div>
                <div class="card-content">
                    <div class="row">
                        <ul>
                            <li>Nom : {{$semestre->nom}}</li>
                        </ul>
                    </div>
                    @if($semestre->matieres()->count() > 0)
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
                                    @foreach($semestre->matieres as $matiere)
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
    @if($semestre->matieres()->count() > 0)
        <!-- dataTables js -->
        <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#matieresTable').DataTable();
            });
        </script>
    @endif
@endsection
