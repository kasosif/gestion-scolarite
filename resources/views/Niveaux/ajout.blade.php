@extends('layouts.app')
@section('title')
    Ajouter Un Niveau
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
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
            <h1> Ajouter Un Niveau</h1>
            <small>Interface d'ajout de niveau</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('niveau.index')}}">Liste Niveaux</a></li>
                <li>Ajouter Un Niveau</li>
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
            <form action="{{route('niveau.store')}}" method="post" >
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire d'ajout
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="specialite_id" class="control-label">Specialite</label>
                                    <select id="specialite_id" name="specialite_id" required class="form-control">
                                        <option value="" selected disabled>Selectionner Specialite</option>
                                        @foreach($specs as $spec)
                                            <option value="{{$spec->id}}">{{$spec->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <label for="nom" class="">Nom</label>
                                    <input id="nom" name="nom" type="text" class="validate" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="matieres" class="control-label">Matieres</label>
                                    <select id="matieres" name="matieres[]" multiple>
                                        @foreach($matieres as $matiere)
                                            <option value="{{$matiere->id}}">{{$matiere->nom}}</option>
                                        @endforeach
                                    </select>
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
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#matieres').select2();
            $('#specialite_id').select2();
        });
    </script>
@endsection
