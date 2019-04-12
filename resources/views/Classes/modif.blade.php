@extends('layouts.app')
@section('title')
    Modifier Une Classe
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection
@section('basesactive')
    class="active"
@endsection
@section('classeactive')
    class="active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Modifier Une Classe</h1>
            <small>Interface de modification de classe</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('classe.index')}}">Liste des Classes</a></li>
                <li>Modifier Une Classe</li>
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
            <form action="{{route('classe.update',['id' => $classe->id])}}" method="post">
                <input name="_method" type="hidden" value="PUT">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire de modification
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="niveau_id" class="control-label">Niveau</label>
                                    <select required id="niveau_id" name="niveau_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Niveau</option>
                                        @foreach($specs as $spec)
                                            <optgroup label="{{$spec->nom}}">
                                                @foreach($spec->niveaux as $niveau)
                                                    <option @if($niveau->id ==$classe->niveau->id) selected @endif value="{{$niveau->id}}">{{$spec->nom}} {{$niveau->nom}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <input id="abbreviation" value="{{$classe->abbreviation}}" name="abbreviation" type="text" class="validate" required>
                                    <label for="abbreviation" class="">Abbreviation</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <input id="code" value="{{$classe->code}}" name="code" type="text" class="validate" required>
                                    <label for="code" class="">Code</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="input-field form-input">
                                    <input id="promotion" value="{{$classe->promotion}}" name="promotion" type="text" class="validate" required>
                                    <label for="promotion" class="">Promotion</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-labeled btn-success">
                                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Modifier
                            </button>
                            <button type="reset" class="btn btn-labeled btn-danger">
                                <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scriptpage')
@endsection
