@extends('layouts.app')
@section('title')
    Profile
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.css')}}">
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('compteactive')
    active
@endsection
@section('profilactive')
    class= "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-user"></i>
        </div>
        <div class="header-title">
            <h1> Profile</h1>
            <small> Votre Profile</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('profile')}}">Profile</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <!--left col-->
                <div class="card">
                    <div class="card-header">
                        <h2>Profile</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div id="picture-container">
                                    <center>
                                        <img title="profile image" class="thumbnail" style="max-width: 200px"
                                             @if(Auth::user()->image)
                                             src="{{asset('images/employes/'.Auth::user()->image)}}"
                                             @elseif(Auth::user()->gendre == 'female')
                                             src="{{asset('assets/dist/img/avatar2.png')}}"
                                             @elseif(Auth::user()->gendre == 'male')
                                             src="{{asset('assets/dist/img/avatar5.png')}}"
                                            @endif
                                        >
                                    </center>
                                    <div class="text-center m-t-5">
                                        <button class="btn btn-primary" id="changetof">Modifier</button>
                                    </div>
                                </div>
                                <div id="change-picture" style="display: none">
                                    <form action="{{route('profile.changepicture')}}" class="form-inline" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <div class="form-group">
                                            <input type="file" width="30" name="image" id="imageuser">
                                        </div>
                                        <div class="form-group m-t-5">
                                            <input type="submit" class="btn btn-success" value="Changer">
                                            <button type="button" class="btn btn-info" id="cancelimage">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Login</strong></span> {{Auth::user()->email}}</li>
                            <li class="list-group-item text-right">
                                <span class="pull-left">
                                    <strong class="">Role: </strong>
                                </span>
                                @if(Auth::user()->role == 'ROLE_ADMIN') Administrateur @elseif(Auth::user()->role == 'ROLE_EMPLOYE') Employe @endif
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Date inscription</strong></span> {{date('D,M Y', strtotime( Auth::user()->created_at))}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/col-3-->
            <div class="col-sm-8" style="" contenteditable="false">
                <div class="card">
                    <div class="card-header">
                        <h2>Informations <small>Info generales...</small></h2>
                    </div>
                    <div class="card-body" style="padding: 10px;">
                        <div id="details" class="row">
                            <div class="col-sm-6">
                                <div>
                                    <label for="prenom" class="">Prénom</label>
                                    <h2 id="prenom">{{Auth::user()->prenom}}</h2>
                                </div>
                                <div>
                                    <label for="cin" class="">CIN</label>
                                    <h2 id="cin">{{Auth::user()->cin}}</h2>
                                </div>
                                <div>
                                    <label for="lieu_naissance" class="">Lieu de Naissance</label>
                                    <h2 id="lieu_naissance">{{Auth::user()->lieu_naissance}}</h2>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <label for="nom" class="">Nom</label>
                                    <h2 id="nom">{{Auth::user()->nom}}</h2>
                                </div>
                                <div>
                                    <label for="gendre">Gendre</label>
                                    <h2 id="gendre">@if(Auth::user()->gendre == 'male') Homme @else Femme @endif</h2>
                                </div>
                                <div class="form-group">
                                    <label for="date_naissance" class="">Date de Naissance</label>
                                    <h2 id="date_naissance">{{date('d-m-Y', strtotime( Auth::user()->date_naissance))}}</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button class="btn btn-primary" id="changedetails">Modifier</button>
                            </div>
                        </div>
                        <div class="row" style="display: none" id="formcontainer">
                            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="col-sm-6">
                                    <div class="input-field form-input">
                                        <label for="prenom" class="">Prénom</label>
                                        <input id="prenom" value="{{Auth::user()->prenom}}" name="prenom" type="text" class="validate" required>

                                    </div>
                                    <div class="input-field form-input">
                                        <label for="cin" class="">CIN</label>
                                        <input disabled id="cin" value="{{Auth::user()->cin}}" type="text" class="validate" required>

                                    </div>
                                    <div class="input-field form-input">
                                        <label for="lieu_naissance" class="">Lieu de Naissance</label>
                                        <input id="lieu_naissance" value="{{Auth::user()->lieu_naissance}}" name="lieu_naissance" type="text" class="validate" required>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-field form-input">
                                        <label for="nom" class="">Nom</label>
                                        <input id="nom" value="{{Auth::user()->nom}}" name="nom" type="text" class="validate" required>

                                    </div>
                                    <div class="input-field form-input">
                                        <select id="gendre" name="gendre" class="form-control" required>
                                            <option value="" disabled>Selectionnez Gendre</option>
                                            <option @if(Auth::user()->gendre == 'male') selected @endif value="male">Homme</option>
                                            <option @if(Auth::user()->gendre == 'female') selected @endif value="female">Femme</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_naissance" class="">Date de Naissance</label>
                                        <input value="{{Auth::user()->date_naissance}}" name="date_naissance" id= "date_naissance" class="form-control" type="date" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Modifier
                                    </button>
                                    <button type="button" id="canceldetails" class="btn btn-labeled btn-danger">
                                        <span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->role == 'ROLE_EMPLOYE')
                    <div class="card">
                        <div class="card-header">
                            <h2>Privileges <small>Vos autorisations...</small></h2>
                        </div>
                        <div class="card-body">
                            <div class="row" style="padding: 10px">
                                @foreach(Auth::user()->privileges as $privilege)
                                    <div class="col-md-3">
                                        <h2>
                                            <span class="label green">{{$privilege->titre}}</span>
                                        </h2>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2>Sécurité <small>Changer Votre Mot de Passe</small></h2>
                    </div>
                    <div class="card-body " >
                            <div class="row">
                                <form action="{{route('profile.changepassword')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="input-field form-input">
                                        <label for="password" class="">Mot de passe Actuel</label>
                                        <input id="password" type="password" placeholder="Mot de passe Actuel" class="validate" name="password" required>
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="new_password" class="">Nouveau Mot de passe</label>
                                        <input id="new_password" type="password" placeholder="Nouveau Mot de passe (8 caractères contenant au moins un chiffre)" name="new_password" class="validate" required>
                                    </div>
                                    <div class="input-field form-input">
                                        <label for="new_password_confirmation" class="">Confirmer Nouveau Mot de passe</label>
                                        <input id="new_password_confirmation" type="password" name="new_password_confirmation" placeholder="Confirmer Nouveau Mot de passe" class="validate" required>
                                    </div>
                                    <button type="submit" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Changer
                                    </button>
                                </form>
                            </div>
                    </div>
                </div>
                <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scriptpage')
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif

            @if ($message = Session::get('error'))
            iziToast.error({
                title: 'Error',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
            $('body').on('click','#changetof',function () {
                $("#picture-container").hide();
                $("#change-picture").show();
            });

            $('body').on('click','#cancelimage',function () {
                $("#picture-container").show();
                $("#change-picture").hide();
            });

            $('body').on('click','#changedetails',function () {
                $("#details").hide();
                $("#formcontainer").show();
            });

            $('body').on('click','#canceldetails',function () {
                $("#details").show();
                $("#formcontainer").hide();
            });

            $("#imageuser").fileinput({
                'showUpload': !1,
                'allowedFileExtensions': ["jpeg","jpg", "png"],
                'showCaption':!1,
                'minFileSize': 5,
                'maxFileSize': 2200
            });

        });
    </script>
@endsection
