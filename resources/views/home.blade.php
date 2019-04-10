@extends('layouts.app')
@section('title')
    Tableau de Board
@endsection
@section('csspage')
@endsection
@section('dashactive')
    class= "active-link"
@endsection
@section('HeaderPage')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-tachometer"></i>
        </div>
        <div class="header-title">
            <h1> Tableau De Board</h1>
            <small> Votre Page D'accueil</small>
            <ul class="link hidden-xs">
                <li><i class="fa fa-home"></i>Accueil</li>
                <li><a href="{{route('home')}}">Tableau de Bord</a></li>
            </ul>
        </div>
    </section>
@endsection
@section('ContenuPage')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="panel cardbox bg-primary">
                    <div class="panel-body card-item panel-refresh">
                        <div class="refresh-container"><i class="fa fa-spinner fa-spin fa-5x"></i></div>
                        <div class="timer" data-to="{{$classesnb}}" data-speed="1500">0</div>
                        <div class="cardbox-icon">
                            <i class="material-icons">school</i>
                        </div>
                        <div class="card-details">
                            <h4>Classes</h4>
                            @can('view',\App\Model\Classe::class)
                                <span>
                                    <a style="color: black" href="{{route('classe.index')}}">Acceder</a>
                                </span>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="panel cardbox bg-success">
                    <div class="panel-body card-item panel-refresh">
                        <div class="timer" data-to="{{$etudiantsnb}}" data-speed="1500">0</div>
                        <div class="cardbox-icon">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                        <div class="card-details">
                            <h4>Etudiants</h4>
                            @can('viewEtudiant',\App\Model\User::class)
                                <span>
                                    <a style="color: black" href="{{route('etudiant.index')}}">Acceder</a>
                                </span>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="panel cardbox bg-warning">
                    <div class="panel-body card-item panel-refresh">
                        <div class="timer" data-to="{{$specialitesnb}}" data-speed="1500">0</div>
                        <div class="cardbox-icon">
                            <i class="material-icons">apps</i>
                        </div>
                        <div class="card-details">
                            <h4>Spécialites</h4>
                            @can('view',\App\Model\Specialite::class)
                                <span>
                                    <a style="color: black" href="{{route('specialite.index')}}">Acceder</a>
                                </span>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-pie-chart fa-lg"></i>
                        <h2>Nombre de Classe par Spécialite</h2>
                    </div>
                    <div class="card-content">
                        <canvas id="flotChart7" width="400" height="246"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-pie-chart fa-lg"></i>
                        <h2>Utilisateurs Par Pourcentage</h2>
                    </div>
                    <div class="card-content">
                        <div class="flotChart">
                            <div id="flotChart8" class="flotChart-demo"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptpage')
    <!-- Flot Charts js -->
    <script src="{{asset('assets/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/flot/jquery.flot.pie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/chartJs/Chart.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            var data8 = [
                {
                    label: "Etudiants",
                    data: '{{$etudiantsnb}}',
                    color: "green"
                },
                {
                    label: "Profs",
                    data: '{{$profsnb}}',
                    color: "blue"
                },
                {
                    label: "Agents",
                    data: '{{$agentsnb}}',
                    color: "black"
                }
            ];
            var chartUsersOptions8 = {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            };
            $.plot($("#flotChart8"), data8, chartUsersOptions8);
            var ctx = $('#flotChart7');
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [
                        @forEach($specialites as $specialite)
                        '{{$specialite->nom}}',
                        @endforeach
                    ],
                    datasets: [{
                        label: '# of Classes',
                        data: [
                            @forEach($specialites as $specialite)
                                '{{$specialite->niveaux()->count()}}',
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: Chart.defaults.doughnut
            });
        })
    </script>
@endsection
