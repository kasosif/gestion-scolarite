@extends('layouts.app')
@section('title')
    Ajouter Une Abscence
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.css')}}">
@endsection
@section('etudiantactive')
    class="active"
@endsection
@section('abscenceetudiantactive')
    class="active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter Une Abscence</h1>
            <small>Interface d'ajout d'abscence</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('abscence.index')}}">Liste des Abscences</a></li>
                <li>Ajouter Une Abscence</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('abscence.index')}}" class="btn btn-default w-md">Retour</a>
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
            <form action="{{route('abscence.store')}}" method="post">
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
                                    <label for="matiere_id" class="control-label">Matiere</label>
                                    <select required id="matiere_id" name="matiere_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Matiere</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="user_id" class="control-label">Etudiant</label>
                                    <select required id="user_id" name="user_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Etudiant</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="seance_id" class="control-label">Seance</label>
                                    <select required id="seance_id" name="seance_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Seance</option>
                                        @foreach($seances as $seance)
                                            <option value="{{$seance->id}}">{{date('H:i', strtotime($seance->heure_debut))}} => {{date('H:i', strtotime($seance->heure_fin))}}</option>
                                        @endforeach
                                    </select>
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
                                    <label for="justifie" class="control-label">Justification</label>
                                    <select required id="justifie" name="justifie" class="form-control">
                                        <option value="" selected disabled>Selectionnez Justification</option>
                                        <option value="1">Justifié</option>
                                        <option value="0">Non Justifié</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date_pub">Date</label>
                                    <input name="date" id= "date_pub" class="validate" type="date">
                                </div>
                            </div>
                            <div class="col-md-8" id="contenuJustif">

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
    <script src="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('body').on('change','#annee_id',function () {
                $.ajax({
                    url: '{{route('ajax.classesbyannee')}}'+'/'+ $('#annee_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#classe_id").html(response);
                        $("#matiere_id").html('');
                        $("#user_id").html('');
                    }
                });
            });
            $('body').on('change','#classe_id',function () {
                $.ajax({
                    url: '{{route('ajax.matieresbyclasse')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#matiere_id").html(response);
                    }
                });
                $.ajax({
                    url: '{{route('ajax.studentsbyclass')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#user_id").html(response);
                    }
                });
            });

            $('body').on('change','#justifie',function () {
                if ($('#justifie').val() === '1'){
                    $('#contenuJustif').html('<label for="justification">Justification</label>\n' +
                        '<input type="file" name="justification" id="justifphoto" required>');
                    $("#justifphoto").fileinput({
                        'showUpload': !1,
                        'allowedFileExtensions': ["jpeg","jpg", "png"],
                        'minFileSize': 5,
                        'maxFileSize': 2200
                    });
                }
                if ($('#justifie').val() === '0'){
                    $('#contenuJustif').html('<label for="commentaire">Commentaire</label>\n' +
                        '<textarea required name="commentaire" id="commentaire" cols="100" rows="500"></textarea>');
                }
            });
        });
    </script>
@endsection
