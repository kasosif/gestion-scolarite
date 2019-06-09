@extends('layouts.app')
@section('title')
    Ajouter un Emploi
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
@endsection
@section('emploisactive')
    class = "active"
@endsection
@section('emploisajoutactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Ajouter un Emploi</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('emplois.create')}}">Ajouter un Emploi</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('emplois.classes')}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Parametres initiaux
                </div>
                <div class="card-content">
                    <div class="row" style="padding: 4px">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="semaine" class="">Semaine</label>
                                <input id="semaine" name="semaine" type="text" class="validate" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="annee" class="control-label">Année</label>
                            <select required id="annee" name="annee_id" class="form-control select2">
                                <option value="" selected disabled>Selectionnez Année</option>
                                @foreach($annees as $annee)
                                    <option value="{{$annee->id}}">{{$annee->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="classe" class="control-label">Classe</label>
                            <select required id="classe" name="classe_id" class="form-control select2">
                                <option value="" selected disabled>Selectionnez Classe</option>
                            </select>
                        </div>
                        <div id="dates-container">

                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-labeled btn-primary m-t-20">
                                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Valider
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Ajouter un Emploi
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table  class="table table-striped table-bordered table-hover table-checkable" id="datatable_orders" >
                            <thead>
                            <tr>
                                <td>Jour/Seance</td>
                                @foreach($seances as $seance)
                                    <td>{{date('H:i', strtotime($seance->heure_debut))}} => {{date('H:i', strtotime($seance->heure_fin))}}</td>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jours as $jour)
                                <tr id="{{ $jour->id }}">
                                    <td width="10%;">{{ $jour->nom }}</td>
                                    @foreach($seances as $seance)
                                        <td id="{{ $seance->id }}">
                                            <div class="input-group">
                                                <select title="Matiere" name="sel[{{ $jour->id }}][{{$seance->id }}]" class="form-control select2">
                                                    <option value="" selected disabled>Matiere</option>
                                                    @foreach($affectations as $affectation)
                                                        <option value="{{ $affectation->matiere->id }}"  name="mat[{{ $jour->id }}][{{ $seance->id }}]">{{ $affectation->matiere->nom }} ({{$affectation->user->nom}} {{$affectation->user->prenom}})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <select title="Salle" name="salle[{{ $jour->id }}][{{ $seance->id }}]"  class="form-control select2 col-cm-6">
                                                    <option value="" selected disabled>Salle</option>
                                                    @foreach($salles as $salle)
                                                        <option value="{{ $salle->id }}"  name="prof[{{ $jour->id }}][{{ $seance->id }}]">{{ $salle->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./cotainer -->
    </div>
@endsection
@section('scriptpage')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('body').on('change','#annee',function () {
                $.ajax({
                    url: '{{route('ajax.classesbyannee')}}'+'/'+ $('#annee').val(),
                    method: "GET",
                    success: function(response) {
                        $("#classe").html(response);
                        $("#dates-container").html('');
                    }
                });
            });
            $('body').on('change','#classe',function () {
                $.ajax({
                    url: '{{route('ajax.datesforemploi')}}'+'/'+ $('#annee').val()+'/'+ $('#classe').val(),
                    method: "GET",
                    success: function(response) {
                        $("#dates-container").html(response);
                    }
                });
            });

        });
    </script>
@endsection
