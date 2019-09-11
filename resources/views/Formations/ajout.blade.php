@extends('layouts.app')
@section('title')
    Ajouter Une Formation
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
@endsection
@section('formationactive')
    class="active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter Une Formation</h1>
            <small>Interface d'ajout de formation</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('formation.index')}}">Liste des Formations</a></li>
                <li>Ajouter Une Formation</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('formation.index')}}" class="btn btn-default w-md">Retour</a>
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
        <form action="{{route('formation.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire d'ajout
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-12">
                                <div class="input-field form-input">
                                    <label for="titre" class="">Titre</label>
                                    <input id="titre" name="titre" type="text" class="validate" required>
                                </div>
                            </div>
                            <input id="slug" name="slug" type="hidden" class="validate" required>
                            <div class="col-md-4">
                                <h2>Image <small></small></h2>
                                <div class="input-group">
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="compose-textarea">Description</label>
                                    <textarea name="description" required id="compose-textarea" style="height: 100px"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <select id="user" name="user_id" class="form-control select2" required>
                                        <option value="" selected disabled>Selectionnez Proprietaire</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <select id="niveau" name="niveau_id" class="form-control select2" required>
                                        <option value="" selected disabled>Selectionnez Niveau</option>
                                        @foreach($niveaux as $niveau)
                                            <option value="{{$niveau->id}}">{{$niveau->specialite->nom}} {{$niveau->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Parties Formation
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <select id="nbrparties" class="form-control select2" required>
                                        <option value="" selected disabled>Selectionnez Nombre de partie</option>
                                        @for($i = 1; $i < 11; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="parties"></div>
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
            </div>
        </form>
    </div>
@endsection
@section('scriptpage')
    <script src="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
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
            $('body').on('change', '#nbrparties', function () {
                $.ajax({
                    url: "{{route('ajax.displayparites')}}" + "/" + $('#nbrparties').val(),
                    method: "GET",
                    success: function(response) {
                        $(".parties").html(response);
                        $('.fileinput').fileinput(
                            {
                                'showUpload': !1,
                                'allowedFileExtensions': ["mp4"],
                                'showCaption':!1,
                                'minFileSize': 5,
                                'maxFileSize': 50000
                            }
                        );
                    }
                });
            });
        });
    </script>
@endsection
