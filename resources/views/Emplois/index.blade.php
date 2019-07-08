@extends('layouts.app')
@section('title')
    Liste des Emplois
@endsection
@section('preloader')
@endsection
@section('csspage')
    <!-- dataTables css -->
    <link href="{{asset('assets/plugins/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
@endsection
@section('emploisactive')
    class = "active"
@endsection
@section('emploislisteactive')
    class = "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-list"></i>
        </div>
        <div class="header-title">
            <h1> Liste des Emplois</h1>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('emplois.classes')}}">Liste Emplois Par Classes</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')

    <div class="container-fluid">
        {{--@can('create',\App\Model\Annee::class)--}}
        <div class="row">
            <a href="{{route('emplois.create')}}" class="waves-effect waves-light btn m-b-10 m-t-5">Ajouter Emploi</a>
        </div>
        {{--@endcan--}}
        <div class="row">
            @if($annees->count() != 0)
                @foreach($annees as $annee)
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-table fa-lg"></i>
                            Liste des Emplois de l'année scolaire {{$annee->nom}}
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Classe</th>
                                        <th>Emplois</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classes as $classe)
                                        @if($classe->annee_id == $annee->id)
                                            <tr>
                                                <td>
                                                    {{\App\Model\Niveau::find($classe->niveau_id)->specialite->nom}} {{$classe->abbreviation}} {{\App\Model\Niveau::find($classe->niveau_id)->nom}}
                                                </td>
                                                <td>
                                                    <a href="{{route('emplois.classe',['classe_id'=>$classe->id])}}" class="btn btn-info w-md">Emplois({{
                                                     \App\Model\Emploi::where('classe_id', '=', $classe->id)->distinct()->get()->count() / 24
                                                    }})</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning z-depth-1">
                    <strong>Oops!</strong> Aucune Année Scolaire Trouvé.
                </div>
            @endif
        </div>
        <!-- ./cotainer -->
    </div>
@endsection
@section('scriptpage')
    <!-- dataTables js -->
    <script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}" type="text/javascript"></script>
    <!-- iziToast -->
    <script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
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
