@extends('layouts.app')
@section('title')
    Information Sur Specialité "{{$specialite->nom}}"
@endsection
@section('preloader')
@endsection
@section('csspage')
    @if($specialite->niveaux()->count() > 0)
        <!-- dataTables css -->
        <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    @endif
@endsection
@section('basesactive')
    class = "active"
@endsection
@section('specialiteactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> {{$specialite->nom}}</h1>
            <small>Interface d'information de specialite</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('specialite.index')}}">Liste Specialités</a></li>
                <li>{{$specialite->nom}}</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('specialite.index')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Info Specialité

                </div>
                <div class="card-content">
                    <div class="row">
                        <ul>
                            <li>Nom : {{$specialite->nom}}</li>
                            <li>Nom Anglais : {{$specialite->nom_en === null ? 'pas de nom' : $specialite->nom_en}}</li>
                            <li>Nom Arabe : {{$specialite->nom_ar === null ? 'pas de nom' : $specialite->nom_ar}}</li>
                            <li>Code : {{$specialite->code}}</li>
                        </ul>
                    </div>
                    @if($specialite->niveaux()->count() > 0)
                        <div class="row">
                            <h2>Mes Classes</h2>
                            <div class="table-responsive">
                                <table id="classesTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Niveau</th>
                                        <th>Code</th>
                                        <th>Abbreviation</th>
                                        <th>Promotion</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($specialite->niveaux as $niveau)
                                        @foreach($niveau->classes as $classe)
                                            <tr>
                                                <td>
                                                    {{$niveau->nom}}
                                                </td>
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
    @if($specialite->niveaux()->count() > 0)
        <!-- dataTables js -->
        <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#classesTable').DataTable();
            });
        </script>
    @endif
@endsection
