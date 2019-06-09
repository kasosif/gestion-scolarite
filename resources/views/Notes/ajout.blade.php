@extends('layouts.app')
@section('title')
    Ajouter Une Note
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('etudiantactive')
    class = "active"
@endsection
@section('noteetudiantactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter Une Note</h1>
            <small>Interface d'ajout de note</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('note.index')}}">Liste Notes</a></li>
                <li>Ajouter Une Note</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('note.index')}}" class="btn btn-default w-md">Retour</a>
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
            <form action="{{route('note.store')}}" method="post" >
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
                                    <label for="spec_id" class="control-label">Specialité</label>
                                    <select required id="spec_id" name="spec_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Specialité</option>
                                        @foreach($annees as $annee)
                                            <optgroup label="{{$annee->nom}}">
                                                @foreach($annee->specialites as $spec)
                                                    <option value="{{$spec->id}}">{{$spec->nom}}</option>
                                                @endforeach
                                            </optgroup>
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
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="devoir_id" class="control-label">Devoir</label>
                                    <select required id="devoir_id" name="devoir_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Devoir</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="loader" style="display: none" class="text-center">
                    <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>

                        <div class="spinner-layer spinner-red">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                        <div class="spinner-layer spinner-green">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="listeEtudiant">
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scriptpage')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('select').select2();
            $('body').on('change','#spec_id',function () {
                $.ajax({
                    url: '{{route('ajax.classesbyspec')}}'+'/'+ $('#spec_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#classe_id").html(response);
                        $("#devoir_id").html('');
                    }
                });
            });
            $('body').on('change','#classe_id',function () {
                $.ajax({
                    url: '{{route('ajax.devoirsbyclasse')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#devoir_id").html(response);
                    }
                });
            });
            $('body').on('change','#devoir_id',function () {
                $('#loader').show();
                $.ajax({
                    url: '{{route('ajax.etudaintsnotes')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $('#loader').hide();
                        $("#listeEtudiant").html(response);
                    }
                });
            });
        });
    </script>
@endsection
