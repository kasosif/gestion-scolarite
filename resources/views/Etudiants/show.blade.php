@extends('layouts.app')
@section('title')
    Details Etudiant
@endsection
@section('csspage')
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('dashactive')
    class= "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-user"></i>
        </div>
        <div class="header-title">
            <h1> Details Etudiant cin : {{$etudiant->cin}}</h1>
            <small> Details de l'etudiant</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('etudiant.index')}}">Liste des Etudiants</a></li>
                <li><a href="{{route('etudiant.show',['cin' => $etudiant->cin])}}">Details Etudiant cin : {{$etudiant->cin}}</a></li>
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
                                <img title="profile image" class="thumbnail" style="max-width: 200px"
                                     @if($etudiant->image)
                                     src="{{asset('images/etudiants/'.$etudiant->image)}}"
                                     @elseif($etudiant->gendre == 'female')
                                     src="{{asset('assets/dist/img/avatar2.png')}}"
                                     @elseif($etudiant->gendre == 'male')
                                     src="{{asset('assets/dist/img/avatar5.png')}}"
                                    @endif
                                >
                            </li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Login</strong></span> {{$etudiant->email}}</li>
                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Date inscription</strong></span> {{date('D,M Y', strtotime( $etudiant->created_at))}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/col-3-->
            <div class="col-sm-8" style="" contenteditable="false">
                <div class="card">
                    <div class="card-header">
                        <h2>Documents <small>documents de l'etudiants...</small></h2>
                    </div>
                    <div class="card-body" style="padding: 10px">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{route('etudiant.carte',['cin'=>$etudiant->cin])}}" class="btn btn-info">Carte Etudiant</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('etudiant.attestaionpresence',['cin'=>$etudiant->cin])}}" class="btn btn-info">Attestation de presence</a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{route('etudiant.attestaioninscription',['cin'=>$etudiant->cin])}}" class="btn btn-info">Attestation d'inscription</a>
                            </div>
                        </div>
                        @if(($etudiant->nom_ar) && ($etudiant->prenom_ar) && ($etudiant->lieu_naissance_ar))
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info">Attestation de presence Arabe</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info">Attestation d'inscription Arabe</button>
                                </div>
                            </div>
                        @endif
                        @if(($etudiant->nom_ar) && ($etudiant->prenom_ar) && ($etudiant->lieu_naissance_ar))
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info">Bulletin</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info">Attestation de reussite</button>
                                </div>
                            </div>
                        @endif
                        @if($etudiant->classe->niveau->specialite->annee->date_fin > date('today'))
                            <div class="col-md-4">
                                <button type="button" class="btn btn-info">Attestation de reussite</button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Informations <small>Info generales...</small></h2>
                    </div>
                    <div class="card-body" style="padding: 10px;">
                        <div class="row">
                            <div class="col-md-8">
                                <div>
                                    <label for="Specialite" class="">Specialite</label>
                                    <h2 id="Specialite">{{$etudiant->classe->niveau->specialite->nom}}</h2>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <label for="Classe" class="">Classe</label>
                                    <h2 id="Classe">{{$etudiant->classe->niveau->nom}} {{$etudiant->classe->abbreviation}}</h2>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <label for="prenom" class="">Prénom</label>
                                    <h2 id="prenom">{{$etudiant->prenom}}</h2>
                                </div>
                                @if($etudiant->prenom_ar)
                                    <div>
                                        <label for="prenom_ar" class="">Prénom Arabe</label>
                                        <h2 id="prenom_ar">{{$etudiant->prenom_ar}}</h2>
                                    </div>
                                @endif
                                <div>
                                    <label for="cin" class="">CIN</label>
                                    <h2 id="cin">{{$etudiant->cin}}</h2>
                                </div>
                                <div>
                                    <label for="lieu_naissance" class="">Lieu de Naissance</label>
                                    <h2 id="lieu_naissance">{{$etudiant->lieu_naissance}}</h2>
                                </div>
                                @if($etudiant->lieu_naissance_ar)
                                    <div>
                                        <label for="lieu_naissance_ar" class="">Lieu de Naissance Arabe</label>
                                        <h2 id="lieu_naissance_ar">{{$etudiant->lieu_naissance_ar}}</h2>
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <div>
                                    <label for="nom" class="">Nom</label>
                                    <h2 id="nom">{{$etudiant->nom}}</h2>
                                </div>
                                @if($etudiant->nom_ar)
                                    <div>
                                        <label for="nom_ar" class="">Nom Arabe</label>
                                        <h2 id="nom_ar">{{$etudiant->nom_ar}}</h2>
                                    </div>
                                @endif
                                <div>
                                    <label for="gendre">Gendre</label>
                                    <h2 id="gendre">@if($etudiant->gendre == 'male') Homme @else Femme @endif</h2>
                                </div>
                                <div class="form-group">
                                    <label for="date_naissance" class="">Date de Naissance</label>
                                    <h2 id="date_naissance">{{date('d-m-Y', strtotime( $etudiant->date_naissance))}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a href="{{route('etudiant.index')}}" class="btn btn-default w-md">Retour</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scriptpage')
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            @if ($message = Session::get('success'))
            iziToast.success({
                title: 'Success',
                message: '{{ $message }}',
                position: 'topCenter'
            });
            @endif
        });
    </script>
@endsection
