@extends('layouts.app')
@section('title')
    Modifier Une Formation
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
            <h1> Modifier Une Formation</h1>
            <small>Interface de modification de formation</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('formation.index')}}">Liste des Formations</a></li>
                <li>Modifier la Formation {{$formation->titre}}</li>
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
        <form action="{{route('formation.update',['id'=> $formation->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire de modification
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-12">
                                <div class="input-field form-input">
                                    <label for="titre" class="">Titre</label>
                                    <input id="titre" value="{{$formation->titre}}" name="titre" type="text" class="validate" required>
                                </div>
                            </div>
                            <input id="slug" value="{{$formation->slug}}" name="slug" type="hidden" class="validate" required>
                            <div class="col-md-4">
                                <h2>Image <small></small></h2>
                                @if($formation->image)
                                    <img src="{{asset('images/formations/'.$formation->image)}}" alt="formation image" class="thumbnail" style="max-width: 200px">
                                @endif
                                <div class="input-group">
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="compose-textarea">Description</label>
                                    <textarea name="description" required id="compose-textarea" style="height: 100px">{{$formation->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <select id="user" name="user_id" class="form-control select2" required>
                                        <option value="" selected disabled>Selectionnez Proprietaire</option>
                                        @foreach($users as $user)
                                            <option @if($formation->user->id == $user->id) selected @endif value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <select id="niveau" name="niveau_id" class="form-control select2" required>
                                        <option value="" selected disabled>Selectionnez Niveau</option>
                                        @foreach($niveaux as $niveau)
                                            <option @if($formation->niveau->id == $niveau->id) selected @endif value="{{$niveau->id}}">{{$niveau->specialite->nom}} {{$niveau->nom}}</option>
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
                                        <option value="" selected disabled>Nombre de partie a ajouter</option>
                                        @for($i = 0; $i < 11 - count($formation->partieformations); $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="partiesexistantes">
                                @foreach($formation->partieformations as $key => $partie)
                                    <div class="partie{{$key + 1}}">
                                        <div class="col-md-8">
                                            <div class="input-field form-input">
                                                <label for="titrepartie{{$key + 1}}" class="">Titre</label>
                                                <input disabled value="{{$partie->titre}}" id="titrepartie{{$key + 1}}" name="partie[{{$key + 1}}][titre]" type="text" class="validate" required>
                                            </div>
                                            <video width="400" controls>
                                                <source src="{{route('formation.view',['uuid'=> $partie->uuid])}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="parties">

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
            $('.fileinput').fileinput(
                {
                    'showUpload': !1,
                    'allowedFileExtensions': ["mp4"],
                    'showCaption':!1,
                    'minFileSize': 5,
                    'maxFileSize': 50000
                }
            );
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
                if($('#nbrparties').val() === '0') {
                    $('.parties').html('');
                    $('.fileinput').fileinput(
                        {
                            'showUpload': !1,
                            'allowedFileExtensions': ["mp4"],
                            'showCaption':!1,
                            'minFileSize': 5,
                            'maxFileSize': 50000
                        }
                    );
                } else {
                    $.ajax({
                        url: "{{route('ajax.displayparites')}}" + "/" + $('#nbrparties').val(),
                        method: "GET",
                        success: function (response) {
                            $(".parties").html(response);
                            $('.fileinput').fileinput(
                                {
                                    'showUpload': !1,
                                    'allowedFileExtensions': ["mp4"],
                                    'showCaption': !1,
                                    'minFileSize': 5,
                                    'maxFileSize': 50000
                                }
                            );
                        }
                    });
                }
            });
        });
    </script>
@endsection
