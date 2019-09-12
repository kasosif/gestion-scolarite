@extends('layouts.app')
@section('title')
    Ajouter Une Actualitée
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection
@section('actualiteactive')
    class="active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter Une Actualitée</h1>
            <small>Interface d'ajout d'actualité</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('feed.index')}}">Liste des Actualitées</a></li>
                <li>Ajouter Une Actualitée</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('feed.index')}}" class="btn btn-default w-md">Retour</a>
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
            <form action="{{route('feed.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire d'ajout
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-12">
                                <h2>Image <small></small></h2>
                                <div class="input-group" style="display: inherit !important;">
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-field form-input">
                                    <label for="titre" class="">Titre</label>
                                    <input id="titre" name="titre" type="text" class="validate" required>
                                </div>
                            </div>
                            <input id="slug" name="slug" type="hidden" class="validate" required>
                            <div class="col-md-12">
                                <div class="input-field form-input">
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="" selected disabled>Selectionnez Type</option>
                                        <option value="public">Publique</option>
                                        <option value="classes">Classes</option>
                                        <option value="professeurs">Professeurs</option>
                                        <option value="etudiants">Etudiants</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="choiceContent">

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="compose-textarea">Contenu</label>
                                    <textarea name="contenu" required id="compose-textarea" style="height: 250px"></textarea>
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
    <script src="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#compose-textarea").wysihtml5();
            $("#image").fileinput({
                'showUpload': !1,
                'allowedFileExtensions': ["jpeg","jpg", "png"],
                'showCaption':!1,
                'minFileSize': 5,
                'maxFileSize': 2200
            });
            $('body').on('keyup', '#titre', function () {
                var feedTitle = $('#titre').val().toLowerCase();
                var slugInput = $('#slug');
                var label = $("label[for='slug']");
                label.attr('class','active');
                var titleToSlug = feedTitle.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
                slugInput.val(titleToSlug);
            });
            $('body').on('change','#type',function () {
                var url = '';
                switch ($('#type').val()){
                    case 'classes' : {
                        url = '{{route('ajax.classes')}}';
                        $.ajax({
                            url: url,
                            method: "GET",
                            success: function(response) {
                                $("#choiceContent").html(response);
                                $('.select2').select2({
                                        placeholder: "Selectionnez Classe(s)",
                                    }
                                );
                            }
                        });
                        break;
                    }
                    case 'etudiants' : {
                        url = '{{route('ajax.students')}}';
                        $.ajax({
                            url: url,
                            method: "GET",
                            success: function(response) {
                                $("#choiceContent").html(response);
                                $('.select2').select2({
                                        placeholder: "Selectionnez Etudiant(s)",
                                    }
                                );
                            }
                        });
                        break;
                    }
                    case 'professeurs' : {
                        url = '{{route('ajax.teachers')}}';
                        $.ajax({
                            url: url,
                            method: "GET",
                            success: function(response) {
                                $("#choiceContent").html(response);
                                $('.select2').select2({
                                        placeholder: "Selectionnez Professeur(s)",
                                    }
                                );
                            }
                        });
                        break;
                    }
                    case 'public' : {
                        $("#choiceContent").html('');
                        break;
                    }
                }
            });
        });
    </script>
@endsection
