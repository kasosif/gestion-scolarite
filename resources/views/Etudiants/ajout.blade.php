@extends('layouts.app')
@section('title')
    Ajouter Un Etudiant
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.css')}}">
@endsection
@section('etudiantactive')
    class = "active"
@endsection
@section('listeetudiantactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter Un Etudiant</h1>
            <small>Interface d'ajout d'etudiant</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('etudiant.index')}}">Liste Etudiants</a></li>
                <li>Ajouter un Etudiant</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('etudiant.index')}}" class="btn btn-default w-md">Retour</a>
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
            <form action="{{route('etudiant.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-university fa-lg"></i>
                            <h2>ETUDE <small>Selectionner l'année et la filière pour filtrer les classes...</small></h2>
                        </div>
                        <div class="card-body" style="padding: 4px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="specialite" class="control-label">Specialite</label>
                                    <select required id="specialite" name="specialite" class="form-control select2">
                                        <option value="" selected disabled>Selectionnez Specialite</option>
                                        @foreach($annees as $annee)
                                            <optgroup label="{{$annee->nom}}">
                                                @foreach($annee->specialites as $specialite)
                                                    <option value="{{$specialite->id}}">{{$specialite->nom}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="classe" class="control-label">Classe</label>
                                    <select id="classe" name="classe_id" class="form-control select2">
                                        <option value="" selected disabled>Selectionner Classe</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-info fa-lg"></i>
                            <h2>INFORMATIONS <small>Details etudiant...</small></h2>
                        </div>
                        <div class="card-body" style="padding: 4px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-field form-input">
                                        <input id="prenom" name="prenom" type="text" class="validate" required>
                                        <label for="prenom" class="">Prénom</label>
                                    </div>
                                    <div class="input-field form-input">
                                        <input id="prenom_ar" name="prenom_ar" type="text" class="validate" >
                                        <label for="prenom_ar" class="">Prénom Arabe</label>
                                    </div>
                                    <div class="input-field form-input">
                                        <input id="prenom_en" name="prenom_en" type="text" class="validate" >
                                        <label for="prenom_en" class="">Prénom Anglais</label>
                                    </div>
                                    <div class="input-field form-input">
                                        <input id="cin" name="cin" type="text" class="validate" required>
                                        <label for="cin" class="">CIN</label>
                                    </div>
                                    <div class="input-field form-input">
                                        <input id="lieu_naissance" name="lieu_naissance" type="text" class="validate" required>
                                        <label for="lieu_naissance" class="">Lieu de Naissance</label>
                                    </div>
                                    <div class="input-field form-input">
                                        <input id="lieu_naissance_en" name="lieu_naissance_en" type="text" class="validate">
                                        <label for="lieu_naissance_en" class="">Lieu de Naissance Anglais</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-field form-input">
                                        <input id="nom" name="nom" type="text" class="validate" required>
                                        <label for="nom" class="">Nom</label>
                                    </div>
                                    <div class="input-field form-input">
                                        <input id="nom_ar" name="nom_ar" type="text" class="validate" >
                                        <label for="nom_ar" class="">Nom Arabe</label>
                                    </div>
                                    <div class="input-field form-input">
                                        <input id="nom_en" name="nom_en" type="text" class="validate" >
                                        <label for="nom_en" class="">Nom Anglais</label>
                                    </div>
                                    <div class="input-field form-input">
                                        <select id="gendre" name="gendre" class="form-control" required>
                                            <option value="" selected disabled>Selectionnez Gendre</option>
                                            <option value="male">Homme</option>
                                            <option value="female">Femme</option>
                                        </select>
                                    </div>
                                    <div class="input-field form-input">
                                        <input id="lieu_naissance_ar" name="lieu_naissance_ar" type="text" class="validate">
                                        <label for="lieu_naissance_ar" class="">Lieu de Naissance Arabe</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_naissance" class="">Date de Naissance</label>
                                        <input name="date_naissance" id= "date_naissance" class="form-control" type="date" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-labeled btn-success">
                        <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Ajouter
                    </button>
                    <button type="reset" class="btn btn-labeled btn-danger">
                        <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Annuler
                    </button>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-picture-o fa-lg"></i>
                            <h2>Image <small>Photo de Profil ...</small></h2>
                        </div>
                        <div class="card-body" style="padding: 4px;">
                            <div class="input-group">
                                <input type="file" name="image" id="imageuser">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-lock fa-lg"></i>
                            <h2>SECURITE <small>Parametres de Connexion ...</small></h2>
                        </div>
                        <div class="card-body" style="padding: 4px">
                            <div class="input-field form-input">
                                <input id="email" name="email" type="email" class="validate" required>
                                <label for="email" class="">Email</label>
                            </div>
                            <div class="input-field form-input">
                                <input disabled id="username" name="username" type="text" class="form-control" required>
                            </div>
                            <div class="input-field form-input">
                                <input id="password" name="password" type="password" class="validate" required>
                                <label for="password" class="">Mot de Passe</label>
                            </div>
                            <div class="input-field form-input">
                                <input id="password-confirm" name="password_confirmation" type="password" class="validate" required>
                                <label for="password-confirm" class="">Confirmation Mot de Passe</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scriptpage')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('#cin').keyup(function () {
                $('#username').val('login : ' + $('#cin').val());
            });
            $("#imageuser").fileinput({
                'showUpload': !1,
                'allowedFileExtensions': ["jpeg","jpg", "png"],
                'showCaption':!1,
                'minFileSize': 5,
                'maxFileSize': 2200
            });
            $('body').on('change','#specialite',function () {
                $.ajax({
                    url: '{{route('ajax.classesbyspec')}}'+'/'+ $('#specialite').val(),
                    method: "GET",
                    success: function(response) {
                        $("#classe").html(response);
                    }
                });
            });
        });
    </script>
@endsection
