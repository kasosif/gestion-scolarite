@extends('layouts.app')
@section('title')
    Ajouter Une Matiere
@endsection
@section('preloader')
@endsection
@section('csspage')
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
            <h1> Ajouter Une Matiere</h1>
            <small>Interface d'ajout de matiere</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('matiere.index')}}">Liste Matieres</a></li>
                <li>Ajouter Une Matiere</li>
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
            <form action="{{route('matiere.store')}}" method="post" >
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
                                    <label for="annee_id" class="control-label">Année</label>
                                    <select required id="annee_id" name="annee_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Année</option>
                                        @foreach($annees as $annee)
                                            <option value="{{$annee->id}}">{{$annee->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="semestre_id" class="control-label">Semestre</label>
                                    <select required id="semestre_id" name="semestre_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Semestre</option>
                                        @foreach($semestres as $semestre)
                                            <option value="{{$semestre->id}}">{{$semestre->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field form-input">
                                    <input id="nom" name="nom" type="text" class="validate" required>
                                    <label for="nom" class="">Nom</label>
                                </div>
                                <div class="input-field form-input">
                                    <input id="nbr_heures" name="nbr_heures" type="number" class="validate" required>
                                    <label for="nbr_heures" class="">Nombre d'heures</label>
                                </div>
                                <div class="input-field form-input">
                                    <input id="horaires" name="horaires" type="number" class="validate" required>
                                    <label for="horaires" class="">Horaires</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classe_id" class="control-label">Classe</label>
                                    <select required id="classe_id" name="classe_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Classe</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="user_id" class="control-label">Professeur</label>
                                    <select required id="user_id" name="user_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Professeur</option>
                                        @foreach($professeurs as $professeur)
                                            <option value="{{$professeur->id}}">{{$professeur->nom}} {{$professeur->prenom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field form-input">
                                    <input id="coeficient" name="coeficient" type="number" class="validate" required>
                                    <label for="coeficient" class="">Coefficient</label>
                                </div>
                                <div class="input-field form-input">
                                    <input id="plafond_abscences" name="plafond_abscences" type="number" class="validate" required>
                                    <label for="plafond_abscences" class="">Plafond Absences</label>
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
    <script>
        $(document).ready(function () {
            $('body').on('change','#annee_id',function () {
                $.ajax({
                    url: '{{route('matiere.classes')}}'+'/'+ $('#annee_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#classe_id").html(response);
                    }
                });
            });
        });
    </script>
@endsection
