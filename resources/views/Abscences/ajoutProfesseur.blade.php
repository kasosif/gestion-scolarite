@extends('layouts.app')
@section('title')
    Ajouter Une Abscence
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
@endsection
@section('professeuractive')
    class="active"
@endsection
@section('abscenceprofesseuractive')
    class="active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter Une Abscence</h1>
            <small>Interface d'ajout d'abscence</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('abscencesprofesseur.index')}}">Liste des Abscences Professeurs</a></li>
                <li>Ajouter Une Abscence</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('abscencesprofesseur.index')}}" class="btn btn-default w-md">Retour</a>
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
            <form action="{{route('abscencesprofesseur.store')}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Selectionner Classe
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
                                <div class="form-group">
                                    <label for="seance_id" class="control-label">Seance</label>
                                    <select required id="seance_id" name="seance_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Seance</option>
                                        @foreach($seances as $seance)
                                            <option value="{{$seance->id}}">{{date('H:i', strtotime($seance->heure_debut))}} => {{date('H:i', strtotime($seance->heure_fin))}}</option>
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
                                <div class="form-group">
                                    <label for="date_pub">Date</label>
                                    <input required min="{{date('Y-m-d', strtotime('-3 days'))}}" max="{{date('Y-m-d', strtotime('today'))}}" name="date" id= "date_pub" class="validate" type="date">
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
                <div id="listeProfesseur">
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
                        $("#matiere_id").html('');
                    }
                });
            });

            $('body').on('change','#classe_id',function () {
                $('#loader').show();
                $.ajax({
                    url: '{{route('ajax.professeurabscence')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $('#loader').hide();
                        $("#listeProfesseur").html(response);
                    }
                });
            });
            $('body').on('change','.abscence',function () {
                if ($(this).prop('checked')) {
                    $(this).parent().parent().parent().parent()
                        .find('td.justification div.col-md-3.m-b-20 label input:checkbox.justifie')
                        .removeAttr('disabled');
                }else {
                    $(this).parent().parent().parent().parent()
                        .find('td.justification div.col-md-3.m-b-20 label input:checkbox.justifie')
                        .attr('disabled',true);
                    $(this).parent().parent().parent().parent()
                        .find('td.justification div.col-md-3.m-b-20 label input:checkbox.justifie')
                        .prop('checked', false);
                }
            });
        });
    </script>
@endsection
