@extends('layouts.app')
@section('title')
    Ajouter Un Devoir
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection
@section('parametreactive')
    class="active"
@endsection
@section('devoiractive')
    class="active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter Un Devoir</h1>
            <small>Interface d'ajout de devoir</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('devoir.index')}}">Liste des Devoirs</a></li>
                <li>Ajouter Un Devoir</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('devoir.index')}}" class="btn btn-default w-md">Retour</a>
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
            <form action="{{route('devoir.store')}}" method="post">
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
                                    <label for="classe_id" class="control-label">Classe</label>
                                    <select required id="classe_id" name="classe_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Classe</option>
                                        @foreach($niveaux as $niveau)
                                            <optgroup label="{{$niveau->specialite->nom}} {{$niveau->nom}}">
                                            @foreach($niveau->classes as $classe)
                                                <option value="{{$classe->id}}">{{$niveau->nom}} {{$classe->abbreviation}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field form-input">
                                    <input id="coeficient" name="coeficient" type="number" class="validate" required>
                                    <label for="coeficient" class="">Coeficient</label>
                                </div>
                                <div class="input-field form-input">
                                    <input name="date" id= "date_pub" class="validate" type="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="matiere_id" class="control-label">Matiere</label>
                                    <select required id="matiere_id" name="matiere_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Matiere</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label">Type</label>
                                    <select required id="type" name="type" class="form-control">
                                        <option value="" selected disabled>Selectionnez Type</option>
                                        <option value="cc">Cc</option>
                                        <option value="ds">Ds</option>
                                        <option value="examen">Examen</option>
                                    </select>
                                </div>
                                <div class="input-field form-input">
                                    <input id="nom" name="nom" type="text" class="validate" required>
                                    <label for="nom" class="">Nom</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-labeled btn-success">
                                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Ajouter
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
    <script>
        $(document).ready(function () {
            $('body').on('change','#classe_id',function () {
                $.ajax({
                    url: '{{route('ajax.matieresbyclasse')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#matiere_id").html(response);
                    }
                });
            });
        });
    </script>
@endsection
