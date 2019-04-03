@extends('layouts.app')
@section('title')
    Modifier Un Devoir
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection
@section('parametreactive')
    class="active"
@endsection
@section('devoiractive')
    class="active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Modifier Un Devoir</h1>
            <small>Interface de modification de devoir</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('devoir.index')}}">Liste des Devoirs</a></li>
                <li>Modifier Un Devoir</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('devoir.index')}}" class="btn btn-default w-md">Retour</a>
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
            <form action="{{route('devoir.update',['id'=> $devoir->id])}}" method="post">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-wpforms"></i>
                        Formulaire de modification
                    </div>
                    <div class="card-body">
                        <div class="row" style="padding: 4px">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="annee_id" class="control-label">Année</label>
                                    <select required id="annee_id" name="annee_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Année</option>
                                        @foreach($annees as $annee)
                                            <option @if($annee->id == $devoir->matiere->classe->annee->id) selected @endif value="{{$annee->id}}">{{$annee->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="matiere_id" class="control-label">Matiere</label>
                                    <select required id="matiere_id" name="matiere_id" class="form-control">
                                        <option value="{{$devoir->matiere->id}}">{{$devoir->matiere->nom}}</option>
                                    </select>
                                </div>
                                <div class="input-field form-input">
                                    <input id="coeficient" value="{{$devoir->coeficient}}" name="coeficient" type="number" class="validate" required>
                                    <label for="coeficient" class="">Coeficient</label>
                                </div>
                                <div class="input-field form-input">
                                    <input value="{{$devoir->date}}" name="date" id= "date_pub" class="validate" type="date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classe_id" class="control-label">Classe</label>
                                    <select required id="classe_id" name="classe_id" class="form-control">
                                        <option value="{{$devoir->matiere->classe->id}}">{{$devoir->matiere->classe->abbreviation}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label">Type</label>
                                    <select required id="type" name="type" class="form-control">
                                        <option value="" selected disabled>Selectionnez Type</option>
                                        <option @if($devoir->type == 'cc') selected @endif value="cc">Cc</option>
                                        <option @if($devoir->type == 'ds') selected @endif value="ds">Ds</option>
                                        <option @if($devoir->type == 'examen') selected @endif value="examen">Examen</option>
                                    </select>
                                </div>
                                <div class="input-field form-input">
                                    <input id="nom" value="{{$devoir->nom}}" name="nom" type="text" class="validate" required>
                                    <label for="nom" class="">Nom</label>
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
    <script>
        $(document).ready(function () {
            $('body').on('change','#annee_id',function () {
                $.ajax({
                    url: '{{route('devoir.classes')}}'+'/'+ $('#annee_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#classe_id").html(response);
                        $("#matiere_id").html('');
                    }
                });
            });
            $('body').on('change','#classe_id',function () {
                $.ajax({
                    url: '{{route('devoir.matieres')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#matiere_id").html(response);
                    }
                });
            });
        });
    </script>
@endsection
