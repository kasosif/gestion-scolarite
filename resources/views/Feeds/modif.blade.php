@extends('layouts.app')
@section('title')
    Modifier Une Actualitée
@endsection
@section('preloader')
@endsection
@section('csspage')
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
            <h1> Modifier Une Actualitée</h1>
            <small>Interface de modification d'actualité</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('feed.index')}}">Liste des Actualitées</a></li>
                <li>Modifier Une Actualitée</li>
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
            <form action="{{route('feed.update',['id' => $feed->id])}}" method="post">
                <input name="_method" type="hidden" value="PUT">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Modification de l'actualite : "{{$feed->titre}}"
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <input id="titre" name="titre" value="{{$feed->titre}}" type="text" class="validate" required>
                                    <label for="titre" class="">Titre</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <input name="date" value="{{$feed->date}}" id="date_pub" class="validate" type="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="" selected disabled>Selectionnez Type</option>
                                        <option @if($feed->type === 'classe') selected @endif value="classe">Classe</option>
                                        <option @if($feed->type === 'professeur') selected @endif value="professeur">Professeur</option>
                                        <option @if($feed->type === 'etudiant') selected @endif value="etudiant">Etudiant</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="choiceContent">
                                @if($feed->type === 'classe')
                                    <div class="input-field form-input">
                                        <select id="classe" name="classe_id" class="form-control" required>
                                            <option value="" selected disabled>Selectionnez Classe</option>
                                            @foreach($classes as $classe)
                                                <option @if($feed->classe->id === $classe->id) selected @endif value="{{$classe->id}}">{{$classe->abbreviation}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @elseif($feed->type === 'professeur')
                                    <div class="input-field form-input">
                                        <select id="user" name="user_id" class="form-control" required>
                                            <option value="" selected disabled>Selectionnez Professeur</option>
                                            @foreach($professeurs as $professeur)
                                                <option @if($feed->user->id === $professeur->id) selected @endif value="{{$professeur->id}}">{{$professeur->nom}} {{$professeur->prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="input-field form-input">
                                        <select id="user" name="user_id" class="form-control" required>
                                            <option value="" selected disabled>Selectionnez Etudiant</option>
                                            @foreach($etudiants as $etudiant)
                                                <option @if($feed->user->id === $etudiant->id) selected @endif value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="compose-textarea">Contenu</label>
                                    <textarea name="contenu" required id="compose-textarea" style="height: 250px">{!! $feed->contenu !!}</textarea>
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
    <script src="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#compose-textarea").wysihtml5();
            $('body').on('change','#type',function () {
                var url = '';
                switch ($('#type').val()){
                    case 'classe' : {
                        url = '{{route('feed.allclasses')}}';
                        break;
                    }
                    case 'etudiant' : {
                        url = '{{route('feed.allstudents')}}';
                        break;
                    }
                    case 'professeur' : {
                        url = '{{route('feed.allteachers')}}';
                        break;
                    }
                }
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        $("#choiceContent").html(response);
                    }
                });
            });
        });
    </script>
@endsection
