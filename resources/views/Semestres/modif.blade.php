@extends('layouts.app')
@section('title')
    Modifier Un Semestre
@endsection
@section('preloader')
@endsection
@section('csspage')
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
            <h1> Modifier Un Semestre</h1>
            <small>Interface de modification de semestre</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('semestre.index')}}">Liste Semestres</a></li>
                <li>Modifier Un Semestre</li>
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
            <form action="{{route('semestre.update',['id'=> $semestre->id])}}" method="post">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire d'ajout
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-8">
                                <div class="input-field form-input">
                                    <input id="nom" value="{{$semestre->nom}}" name="nom" type="text" class="validate" required>
                                    <label for="nom" class="">Nom</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-labeled btn-success">
                        <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Modifier
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
