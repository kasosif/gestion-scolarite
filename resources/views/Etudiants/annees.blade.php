@extends('layouts.app')
@section('title')
    Selectionner Année Scolaire
@endsection
@section('preloader')
@endsection
@section('csspage')
@endsection
@section('etudiantactive')
    class = "active"
@endsection
@section('listeetudiantactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Selection Année Scolaire</h1>
            <small> Selectionnez annee scolaire pour voir la liste des etudiants</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('etudiant.index')}}">Liste Etudiants</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <a href="{{route('etudiant.ajout')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Etudiant</a>
        </div>
        <div class="row">
            @forelse($annees as $annee)
                <div class="col-md-3">
                    <div class="panel cardbox bg-primary">
                        <div class="panel-body card-item panel-refresh">
                            <div class="refresh-container"><i class="refresh-spinner fa fa-spinner fa-spin fa-5x"></i></div>
                            <div class="timer" data-to="{{$annee->mesclasses()->count()}}" data-speed="1500">{{$annee->mesclasses()->count()}}</div><span>nombre de classe(s)</span>
                            <div class="cardbox-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="card-details">
                                <h4><a style="color: white" href="{{route('etudiant.liste',['annee_id' => $annee->id])}}">Année Scolaire : {{ $annee->nom }}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-warning z-depth-1">
                    <strong>Oops!</strong> Aucune Année Scolaire Trouvée.
                </div>
            @endforelse
        </div>
        <div class="row">
            {{$annees->links()}}
        </div>
    </div>
@endsection
@section('scriptpage')
@endsection
