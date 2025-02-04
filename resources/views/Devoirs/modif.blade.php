@extends('layouts.app')
@section('title')
    Modifier Un Devoir
@endsection
@section('preloader')
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
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
                                    <label for="classe_id" class="control-label">Classe</label>
                                    <select required id="classe_id" name="classe_id" class="form-control">
                                        <option value="" selected disabled>Selectionnez Classe</option>
                                        @foreach($niveaux as $niveau)
                                            <optgroup label="{{$niveau->specialite->nom}} {{$niveau->nom}}">
                                                @foreach($niveau->classes as $classe)
                                                    <option @if($classe->id == $devoir->classe->id) selected @endif value="{{$classe->id}}">{{$niveau->nom}} {{$classe->abbreviation}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-field form-input">
                                    <label for="coeficient" class="">Coeficient</label>
                                    <input id="coeficient" step="0.1" value="{{$devoir->coeficient}}" name="coeficient" type="number" class="validate" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="matiere_id" class="control-label">Matiere</label>
                                    <select required id="matiere_id" name="matiere_id" class="form-control">
                                        <option value="{{$devoir->matiere->id}}">{{$devoir->matiere->nom}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label">Type</label>
                                    <select required id="type" name="type" class="form-control">
                                        <option value="" selected disabled>Selectionnez Type</option>
                                        <option @if($devoir->type == 'controle') selected @endif value="controle">Devoir de Controle</option>
                                        <option @if($devoir->type == 'examen') selected @endif value="examen">Examen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="date_pub" class="">Date et heure</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-field form-input">
                                    <input name="date"
                                           value="{{date('Y-m-d\Th:i', strtotime($devoir->date))}}"
                                           id= "date_pub" class="validate" type="datetime-local"
                                           min="{{date('Y-m-d\Th:i', strtotime(Carbon\Carbon::now()->toDateTimeString()))}}"
                                           max="{{date('Y-m-d\Th:i', strtotime($annee->date_fin))}}">
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
                        <div class="clearfix"></div>
                    </div>
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
            $('body').on('change','#classe_id',function () {
                $.ajax({
                    url: '{{route('ajax.matieresbyclasse')}}'+'/'+ $('#classe_id').val(),
                    method: "GET",
                    success: function(response) {
                        $("#matiere_id").html(response);
                    }
                });
            });
        });
    </script>
@endsection
