@extends('layouts.app')
@section('title')
    Ajouter Un Employe
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.css')}}">
@endsection
@section('accesactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter Un Employe</h1>
            <small>Interface d'ajout d'employe</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('employe.index')}}">Liste Employes</a></li>
                <li>Ajouter Un Employe</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('employe.index')}}" class="btn btn-default w-md">Retour</a>
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
        <form action="{{route('employe.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-lock fa-lg"></i>
                        <h2>Privileges <small>autorisations...</small></h2>
                    </div>

                    <div class="card-body">
                        <div class="row" style="padding: 4px;">
                            @foreach($ressources as $ressource)
                                <div class="col-md-12">
                                    <h2>
                                        <a href="#" onclick="toggleRessource('{{str_replace(' ', '', $ressource->ressource)}}')">Droits de gestion des {{$ressource->ressource}}
                                            <i class="fa fa-lock"></i>
                                        </a>
                                    </h2>
                                </div>
                                @foreach(\App\Model\Privilege::where('ressource',$ressource->ressource)->get() as $privilege)
                                    <div @if($ressource->ressource == 'Abcences') class="col-md-4 switch m-b-20" @else class="col-md-3 switch m-b-20" @endif>
                                        <label style="font-size: inherit">
                                            {{$privilege->titre}}
                                            <input type="checkbox" class="{{str_replace(' ', '', $ressource->ressource)}}" name="privileges[]" value="{{$privilege->id}}">
                                            <span class="lever"></span>
                                        </label>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-info fa-lg"></i>
                            <h2>INFORMATIONS <small>Details employe...</small></h2>
                        </div>
                        <div class="card-body" style="padding: 4px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-field form-input">
                                        <label for="prenom" class="">Prénom</label>
                                        <input id="prenom" name="prenom" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="prenom_ar" class="">Prénom Arabe</label>
                                        <input id="prenom_ar" name="prenom_ar" type="text" class="validate" >
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="prenom_en" class="">Prénom Anglais</label>
                                        <input id="prenom_en" name="prenom_en" type="text" class="validate" >
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="cin" class="">CIN</label>
                                        <input id="cin" name="cin" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="lieu_naissance" class="">Lieu de Naissance</label>
                                        <input id="lieu_naissance" name="lieu_naissance" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="lieu_naissance_en" class="">Lieu de Naissance Anglais</label>
                                        <input id="lieu_naissance_en" name="lieu_naissance_en" type="text" class="validate">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-field form-input">
                                        <label for="nom" class="">Nom</label>
                                        <input id="nom" name="nom" type="text" class="validate" required>
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="nom_ar" class="">Nom Arabe</label>
                                        <input id="nom_ar" name="nom_ar" type="text" class="validate" >
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="nom_en" class="">Nom Anglais</label>
                                        <input id="nom_en" name="nom_en" type="text" class="validate" >
                                    </div>
                                    <div class="form-group">
                                        <label for="gendre" class="">Gendre</label>
                                        <select id="gendre" name="gendre" class="form-control" required>
                                            <option value="" selected disabled>Selectionnez Gendre</option>
                                            <option value="male">Homme</option>
                                            <option value="female">Femme</option>
                                        </select>
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="lieu_naissance_ar" class="">Lieu de Naissance Arabe</label>
                                        <input id="lieu_naissance_ar" name="lieu_naissance_ar" type="text" class="validate">
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
                            <div class="input-group" style="width: 100%">
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
                                <label for="email" class="">Email</label>
                                <input id="email" name="email" type="email" class="validate" required>
                            </div>
                            <div class="input-field form-input">
                                <input disabled id="username" name="username" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@section('scriptpage')
    <script src="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
    <script>
        $(document).ready(function () {
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

        });
        function toggleRessource(ressource) {
            event.preventDefault();
            if ($(this).find(">:first-child").attr('class') === 'fa fa-unlock'){
                $(this).find(">:first-child").attr('class','fa fa-lock')
            } else {
                $(this).find(">:first-child").attr('class','fa fa-unlock')
            }
            var checkBoxes = $('.'+ressource);
            checkBoxes.prop("checked", !checkBoxes.prop("checked"))
        }
    </script>
@endsection
