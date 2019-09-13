@extends('layouts.app')
@section('title')
    @if(\Request::route()->getName() == 'abscencesetudiant.edit')
        Modifier les details d'une absence d'un Etudiant
    @else
        Modifier les details d'une absence d'un Professeur
    @endif
@endsection
@section('preloader')
@endsection
@section('csspage') @endsection
@section('abscenceetudiantactive')
    @if(\Request::route()->getName() == 'abscencesetudiant.edit')
        class = "active-link"
    @endif
@endsection
@section('etudiantactive')
    @if(\Request::route()->getName() == 'abscencesetudiant.edit')
        class = "active"
    @endif
@endsection

@section('abscenceprofesseuractive')
    @if(\Request::route()->getName() == 'abscencesprofesseur.edit')
        class = "active-link"
    @endif
@endsection
@section('professeuractive')
    @if(\Request::route()->getName() == 'abscencesprofesseur.edit')
        class = "active"
    @endif
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> @if(\Request::route()->getName() == 'abscencesetudiant.index')
                    Modifier les details d'une absence d'un Etudiant
                @else
                    Modifier les details d'une absence d'un Professeur
                @endif</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li>
                    @if(\Request::route()->getName() == 'abscencesetudiant.edit')
                        <a href="{{route('abscencesetudiant.index')}}">Liste Abscences Etudiants</a>
                    @else
                        <a href="{{route('abscencesprofesseur.index')}}">Liste Abscences Professeurs</a>
                    @endif
                </li>
                <li>
                    Modifier Abscence
                </li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            @if(\Request::route()->getName() == 'abscencesetudiant.edit')
                <div class="pull-right">
                    <a href="{{route('abscencesetudiant.index')}}" class="btn btn-default w-md">Retour</a>
                </div>
            @else
                <div class="pull-right">
                    <a href="{{route('abscencesprofesseur.index')}}" class="btn btn-default w-md">Retour</a>
                </div>
            @endif
        </div>
        @if(\Request::route()->getName() == 'abscencesetudiant.edit')
            <div class="row">
                <form action="{{route('abscencesetudiant.update',['id'=> $absence->id])}}" method="post">
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
                                        <th>Justifie</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if($absence->user->image)
                                                <img src="{{asset('images/etudiants/'.$absence->user->image)}}" alt="User Image" style="width: 50px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            {{$absence->user->prenom}}
                                        </td>
                                        <td>
                                            {{$absence->user->nom}}
                                        </td>
                                        <td class="justification">
                                            <div class="col-md-3 switch m-b-20">
                                                <label style="font-size: inherit">
                                                    <input type="checkbox" @if($absence->justifie) checked @endif class="justifie" name="justifie">
                                                    <span class="lever"></span>
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
        @else
            <div class="row">
                <form action="{{route('abscencesprofesseur.update',['id'=> $absence->id])}}" method="post">
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
                                        <th>Justifie</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if($absence->user->image)
                                                <img src="{{asset('images/professeurs/'.$absence->user->image)}}" alt="User Image" style="width: 50px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            {{$absence->user->prenom}}
                                        </td>
                                        <td>
                                            {{$absence->user->nom}}
                                        </td>
                                        <td class="justification">
                                            <div class="col-md-3 switch m-b-20">
                                                <label style="font-size: inherit">
                                                    <input type="checkbox" @if($absence->justifie) checked @endif class="justifie" name="justifie">
                                                    <span class="lever"></span>
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
    @endif
    <!-- ./cotainer -->
    </div>
@endsection
@section('scriptpage')
@endsection
