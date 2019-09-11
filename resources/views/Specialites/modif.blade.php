@extends('layouts.app')
@section('title')
    Modifier Une Spécialite
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
@endsection
@section('basesactive')
    class = "active"
@endsection
@section('specialiteactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Modifier Une Spécialite</h1>
            <small>Interface de modification de spécialite</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('specialite.index')}}">Liste Specialités</a></li>
                <li>Modifier Une Spécialite</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('specialite.index')}}" class="btn btn-default w-md">Retour</a>
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
            <form action="{{route('specialite.update',['id' => $specialite->id])}}" method="post" >
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire de modification
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-8">
                                <label for="annee" class="control-label">Année</label>
                                <select required id="annee" name="annee_id" class="form-control">
                                    <option value="" selected disabled>Selectionnez Année</option>
                                    @foreach($annees as $annee)
                                        <option @if($specialite->annee->id == $annee->id) selected @endif value="{{$annee->id}}">{{$annee->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <label for="nom" class="">Nom</label>
                                    <input id="nom" value="{{$specialite->nom}}" name="nom" type="text" class="validate" required>
                                </div>
                                <div class="input-field form-input">
                                    <label for="nom_en" class="">Nom Anglais</label>
                                    <input id="nom_en" value="{{$specialite->nom_en}}" name="nom_en" type="text" class="validate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-field form-input">
                                    <label for="nom_ar" class="">Nom Arabe</label>
                                    <input id="nom_ar" value="{{$specialite->nom_ar}}" name="nom_ar" type="text" class="validate">
                                </div>
                                <div class="input-field form-input">
                                    <label for="code" class="">Code</label>
                                    <input id="code"  value="{{$specialite->code}}" name="code" type="text" class="validate" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-labeled btn-success">
                        <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Modifier
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
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#annee').select2();
        });
    </script>
@endsection
