@extends('layouts.app')
@section('title')
    Modifier Emploi
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('emploisactive')
    class = "active"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Modifier Emploi</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('emplois.classes')}}">Liste Emplois</a></li>
                <li><a href="{{route('emplois.classe',['classe_id'=>$classe->id])}}">Emlpois de la Classe</a></li>
                <li>Emlpois de la semaine {{$dateD->format('d-m-Y')}} : {{$dateF->format('d-m-Y')}}</li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="pull-right">
                <a href="{{route('emplois.classe',['classe_id'=>$classe->id])}}" class="btn btn-default w-md">Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-table fa-lg"></i>
                    Modifier Emploi
                </div>
                <form action="{{route('emplois.update')}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="semaine" value="{{$titre_semaine}}">
                    <input type="hidden" name="classe_id" value="{{$classe->id}}">
                    <input type="hidden" name="date_debut" value="{{$emplois[0]->date_debut}}">
                    <input type="hidden" name="date_fin" value="{{$emplois[0]->date_fin}}">
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
                                        @foreach($emplois as $ligne)
                                            @if($ligne->jour->id == $jour->id)
                                                @if($ligne->matiere)
                                                    <td id="{{ $ligne->seance->id }}">
                                                        <div class="input-group">
                                                            <select title="Matiere" name="mat[{{ $jour->id }}][{{$ligne->seance->id }}]" class="form-control select2">
                                                                <option value="" selected disabled>Matiere</option>
                                                                @foreach($affectations as $affectation)
                                                                    <option @if($ligne->matiere->id == $affectation->matiere->id) selected @endif value="{{ $affectation->matiere->id }}">{{ $affectation->matiere->nom }} ({{$affectation->user->nom}} {{$affectation->user->prenom}})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="input-group">
                                                            <select title="Salle" name="salle[{{ $jour->id }}][{{ $ligne->seance->id }}]"  class="form-control select2 col-cm-6">
                                                                <option value="" selected disabled>Salle</option>
                                                                @foreach($salles as $salle)
                                                                    <option @if($ligne->salle->id == $salle->id) selected @endif value="{{ $salle->id }}">{{ $salle->nom }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                @else
                                                    <td id="{{ $ligne->seance->id }}">
                                                        <div class="input-group">
                                                            <select title="Matiere" name="mat[{{ $jour->id }}][{{$ligne->seance->id }}]" class="form-control select2">
                                                                <option value="" selected disabled>Matiere</option>
                                                                @foreach($affectations as $affectation)
                                                                    <option value="{{ $affectation->matiere->id }}">{{ $affectation->matiere->nom }} ({{$affectation->user->nom}} {{$affectation->user->prenom}})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="input-group">
                                                            <select title="Salle" name="salle[{{ $jour->id }}][{{ $ligne->seance->id }}]"  class="form-control select2 col-cm-6">
                                                                <option value="" selected disabled>Salle</option>
                                                                @foreach($salles as $salle)
                                                                    <option value="{{ $salle->id }}">{{ $salle->nom }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                @endif

                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i>Enregistrer</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- ./cotainer -->
    </div>
@endsection
@section('scriptpage')
    <script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
