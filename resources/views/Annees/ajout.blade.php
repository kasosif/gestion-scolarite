@extends('layouts.app')
@section('title')
    Ajouter Une Année Scolaire
@endsection
@section('preloader')
@endsection
@section('csspage')
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
            <h1> Ajouter Une Année Scolaire</h1>
            <small>Interface d'ajout d'année scolaire</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('annee.index')}}">Liste Années Scolaires</a></li>
                <li>Ajouter Une Année Scolaire</li>
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
        @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Opps!</strong> Erreur de l'envoi du formulaire

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>
            <br>
        @endif
        <div class="row">
            <form action="{{route('annee.store')}}" method="post" >
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire d'ajout
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <input id="nom" name="nom" type="text" class="validate" required>
                                    <label for="nom" class="">Nom</label>
                                </div>
                                <div class="form-group">
                                    <label for="date_debut">Date Debut</label>
                                    <input name="date_debut" id= "date_debut" class="form-control" type="date" required>
                                </div>
                                <div class="input-field form-input">
                                    <input id="code" name="code" type="text" class="validate" required>
                                    <label for="code" class="">Code</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <input id="nom_ar" name="nom_ar" type="text" class="validate">
                                    <label for="nom_ar" class="">Nom Arabe</label>
                                </div>
                                <div class="form-group">
                                    <label for="date_fin">Date Fin</label>
                                    <input name="date_fin" id="date_fin" class="form-control" type="date" required>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-labeled btn-success">
                        <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Ajouter
                    </button>
                    <button type="reset" class="btn btn-labeled btn-danger">
                        <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scriptpage')
@endsection
