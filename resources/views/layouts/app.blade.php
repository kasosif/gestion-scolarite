<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/ico/fav.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
@section('css')
    <!-- Styles -->
        <!-- jquery-ui css -->
        <link href="{{asset('assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- materialize css -->
        <link href="{{asset('assets/plugins/materialize/css/materialize.min.css')}}" rel="stylesheet">
        <!-- Bootstrap css-->
        <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Animation Css -->
        <link href="{{asset('assets/plugins/animate/animate.css')}}" rel="stylesheet" />
        <!-- Material Icons CSS -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- simplebar scroll css -->
        <link href="{{asset('assets/plugins/simplebar/dist/simplebar.css')}}" rel="stylesheet" type="text/css" />
        <!-- mCustomScrollbar css -->
        <link href="{{asset('assets/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" type="text/css" />
        <!-- custom CSS -->
        <link href="{{asset('assets/dist/css/stylematerial.css')}}" rel="stylesheet">
    @show
    @yield('csspage')
</head>
<body>
<div id="wrapper">
    <!--navbar top-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <!-- Logo -->
        <a class="navbar-brand pull-left" href="{{route('home')}}">
            <img src="{{asset('assets/dist/img/logo3.png')}}" alt="logo" width="205" height="60">
        </a>
        <a id="menu-toggle">
            <i class="material-icons">apps</i>
        </a>
        <div class="navbar-custom-menu hidden-xs">
            <ul class="navbar navbar-right">
            {{--<!--Notification-->--}}
            {{--<li class="dropdown">--}}
            {{--<a class="dropdown-toggle" data-toggle="dropdown">--}}
            {{--<i class="material-icons">notifications_active</i><span class="numbers">8</span>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu dropdown-message mCustomScrollbar animated bounceIn dropdown-notification" data-mcs-theme="minimal">--}}
            {{--<li class="list-details">--}}
            {{--<!-- start notification -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="pro-images pull-left">--}}
            {{--<img src="assets/dist/img/avatar4.png" class="img-circle" height="40" width="40" alt="User Image">--}}
            {{--</div>--}}
            {{--<h5 class="indigo-text">Mr.alrazy</h5>--}}
            {{--<p>Please oreder 10 pices of kits..</p>--}}
            {{--<span class="badge pro-badge teal">15 hours ago</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start notification -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="pro-images pull-left">--}}
            {{--<img src="assets/dist/img/avatar3.png" class="img-circle" height="40" width="40" alt="User Image">--}}
            {{--</div>--}}
            {{--<h5 class="purple-text">Jahir</h5>--}}
            {{--<p>Please oreder 10 pices of kits..</p>--}}
            {{--<span class="badge pro-badge teal">15 hours ago</span>--}}
            {{--</a>--}}
            {{--</li>--}}

            {{--<li class="list-details">--}}
            {{--<!-- start notification -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="pro-images pull-left">--}}
            {{--<img src="assets/dist/img/avatar2.png" class="img-circle" height="40" width="40" alt="User Image">--}}
            {{--</div>--}}
            {{--<h5 class="blue-text">Karim</h5>--}}
            {{--<p>Please oreder 10 pices of kits..</p>--}}
            {{--<span class="badge pro-badge teal">15 hours ago</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details list-ntfc">--}}
            {{--<!-- start notification -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="pro-images pull-left">--}}
            {{--<img src="assets/dist/img/avatar4.png" class="img-circle" height="40" width="40" alt="User Image">--}}
            {{--</div>--}}
            {{--<h5 class="teal-text">Shipon</h5>--}}
            {{--<p>Please oreder 10 pices of kits..</p>--}}
            {{--<span class="badge pro-badge teal">15 hours ago</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<!-- /.notification -->--}}
            {{--<!--tasks-->--}}
            {{--<li class="list-details dropdown">--}}
            {{--<a class="dropdown-toggle" data-toggle="dropdown" href="typography.html#">--}}
            {{--<i class="material-icons">assignment</i><span class="numbers">6+</span>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu dropdown-message mCustomScrollbar animated bounceIn" data-mcs-theme="minimal">--}}
            {{--<li class="list-details">--}}
            {{--<!-- start tasks -->--}}
            {{--<a href="typography.html#">--}}
            {{--<p>--}}
            {{--<span class="label-primary pro-label label label-default pull-right">35%</span> Data table error--}}
            {{--</p>--}}
            {{--<div class="progress">--}}
            {{--<div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="35%" style="width: 35%">--}}
            {{--<span class="sr-only">35% Complete (primary)</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start message -->--}}
            {{--<a href="typography.html#">--}}
            {{--<p>--}}
            {{--<span class="label-success pro-label label label-default pull-right">55%</span> Change theme color--}}
            {{--</p>--}}
            {{--<div class="progress">--}}
            {{--<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="55%" style="width: 55%">--}}
            {{--<span class="sr-only">55% Complete (primary)</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start message -->--}}
            {{--<a href="typography.html#">--}}
            {{--<p>--}}
            {{--<span class="label-info pro-label label label-default pull-right">60%</span> Change the font-family--}}
            {{--</p>--}}
            {{--<div class="progress">--}}
            {{--<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="60%" style="width: 60%">--}}
            {{--<span class="sr-only">60% Complete (info)</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start message -->--}}
            {{--<a href="typography.html#">--}}
            {{--<p>--}}
            {{--<span class="label-warning pro-label label label-default pull-right">80%</span> Animation skip--}}
            {{--</p>--}}
            {{--<div class="progress">--}}
            {{--<div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="80%" style="width: 80%">--}}
            {{--<span class="sr-only">80% Complete (warning)</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start message -->--}}
            {{--<a href="typography.html#">--}}
            {{--<p>--}}
            {{--<span class="pro-label label label-default deep-purple pull-right">75%</span> Add More Ui--}}
            {{--</p>--}}
            {{--<div class="progress">--}}
            {{--<div class="progress-bar progress-bar-striped deep-purple active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="75%" style="width: 75%">--}}
            {{--<span class="sr-only">75% Complete (purple)</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start message -->--}}
            {{--<a href="typography.html#">--}}
            {{--<p>--}}
            {{--<span class="pro-label label label-default teal pull-right">50%</span> Add visitor--}}
            {{--</p>--}}
            {{--<div class="progress">--}}
            {{--<div class="progress-bar progress-bar-striped teal active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="50%" style="width: 50%">--}}
            {{--<span class="sr-only">50% Complete (teal)</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start message -->--}}
            {{--<a href="typography.html#">--}}
            {{--<p>--}}
            {{--<span class="pro-label label label-default red pull-right">90%</span> system ststus recheck--}}
            {{--</p>--}}
            {{--<div class="progress">--}}
            {{--<div class="progress-bar progress-bar-striped active red" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="90%" style="width: 90%">--}}
            {{--<span class="sr-only">90% Complete (teal)</span>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<!-- /.tasks -->--}}
            {{--<!--tasks-->--}}
            {{--<li class="dropdown">--}}
            {{--<a class="dropdown-toggle" data-toggle="dropdown" href="typography.html#">--}}
            {{--<i class="material-icons">message</i><span class="numbers">9+</span>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu dropdown-message mCustomScrollbar animated bounceIn" data-mcs-theme="minimal">--}}
            {{--<li class="list-details">--}}
            {{--<!-- start tasks -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="tasks pull-left">--}}
            {{--<i class="fa fa-file-text-o blue-grey"></i>--}}
            {{--</div>--}}
            {{--<p>Photo loction should be redy...</p>--}}
            {{--<span class="badge blue-grey">3 days</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start tasks -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="tasks pull-left">--}}
            {{--<i class="fa fa-user-circle blue"></i>--}}
            {{--</div>--}}
            {{--<p>user panel should be redy...</p>--}}
            {{--<span class="badge blue">20 days</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start tasks -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="tasks pull-left">--}}
            {{--<i class="fa fa-file-text indigo"></i>--}}
            {{--</div>--}}
            {{--<p>file loction should be checked...</p>--}}
            {{--<span class="badge indigo">3 days</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start tasks -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="tasks pull-left">--}}
            {{--<i class="fa fa-book deep-purple"></i>--}}
            {{--</div>--}}
            {{--<p>room should be booked...</p>--}}
            {{--<span class="badge deep-purple">6 days</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start tasks -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="tasks pull-left">--}}
            {{--<i class="fa fa-bell red"></i>--}}
            {{--</div>--}}
            {{--<p>tasks are not created directly...</p>--}}
            {{--<span class="badge red">5 days</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li class="list-details">--}}
            {{--<!-- start tasks -->--}}
            {{--<a href="typography.html#">--}}
            {{--<div class="tasks pull-left">--}}
            {{--<i class="fa fa-bullhorn"></i>--}}
            {{--</div>--}}
            {{--<p>projects should be Complete...</p>--}}
            {{--<span class="badge #26a69a">10 days</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--<!-- /.tasks -->--}}
            {{--</li>--}}
            <!--user profile-->
                <li class="dropdown">
                    <a class='dropdown-button user-pro' href='#' data-activates='dropdown-user'>
                        <img src="{{asset('assets/dist/img/avatar5.png')}}" class="img-circle" height="45" width="50" alt="User Image">
                    </a>
                    <ul id='dropdown-user' class='dropdown-content'>
                        <li>
                            <a href="#"><i class="material-icons">perm_identity</i> Mon Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                <i class="material-icons">lock</i> Deconnecter</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
                <!-- /.user profile -->
            </ul>
        </div>
    </nav>
    <!-- Sidebar -->
    <div id="sidebar-wrapper" class="waves-effect" data-simplebar>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li @yield('dashactive')>
                        <a href="{{route('home')}}">
                            <i class="material-icons">dashboard</i>
                            Tableau de Bord
                        </a>
                    </li>
                    <li @yield('etudiantactive')>
                        <a><i class="material-icons">supervisor_account</i>Etudiants<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li @yield('listeetudiantactive')><a href="mailbox.html">Liste des Etudiants</a></li>
                            <li @yield('abscenceetudiantactive')><a href="mailDetails.html">Abscences</a></li>
                            <li @yield('noteetudiantactive')><a href="compose.html">Notes</a></li>
                        </ul>
                    </li>
                    <li @yield('professeuractive')>
                        <a><i class="material-icons">contact_mail</i>Professeurs<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li @yield('listeprofesseuractive')><a href="mailbox.html">Liste des Professeurs</a></li>
                        </ul>
                    </li>
                    <li @yield('actualiteactive')>
                        <a href="{{route('home')}}">
                            <i class="material-icons">rss_feed</i>
                            Actualitées
                        </a>
                    </li>
                    <li @yield('accesactive')>
                        <a href="{{route('home')}}">
                            <i class="material-icons">lock_open</i>
                            Accés
                        </a>
                    </li>
                    <li @yield('parametreactive')>
                        <a><i class="material-icons">build</i>Paramètres<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li @yield('anneeactive')><a href="mailbox.html">Années Scolaires</a></li>
                            <li @yield('semestreactive')><a href="mailDetails.html">Semestres</a></li>
                            <li @yield('specialiteactive')><a href="compose.html">Spécialites</a></li>
                            <li @yield('classeactive')><a href="compose.html">Classes</a></li>
                            <li @yield('seanceactive')><a href="compose.html">Séances</a></li>
                            <li @yield('devoiractive')><a href="compose.html">Devoirs</a></li>
                            <li @yield('matiereactive')><a href="compose.html">Matieres</a></li>
                            <li @yield('salleactive')><a href="compose.html">Salles</a></li>
                        </ul>
                    </li>
                    <li class="side-last"></li>
                </ul>
                <!-- ./sidebar-nav -->
            </div>
            <!-- ./sidebar -->
        </div>
        <!-- ./sidebar-nav -->
    </div>
    <!-- ./sidebar-wrapper -->
    <!-- Page content -->
    <div id="page-content-wrapper">
        <div class="page-content">
            <!-- Content Header (Page header) -->
        @yield('HeaderPage')
        <!-- page section -->
        @yield('ContenuPage')
        <!-- ./cotainer -->
        </div>
        <!-- ./page-content -->
    </div>
    <!-- ./page-content-wrapper -->
</div>
@section('preloader')
    <div id="preloader">
        <div class="preloader-position">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-teal">
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
    </div>
@show
@section('scripts')
    <!-- Scripts -->
    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <!-- jquery-ui -->
    <script src="{{asset('assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- materialize  -->
    <script src="{{asset('assets/plugins/materialize/js/materialize.min.js')}}" type="text/javascript"></script>
    <!-- m-custom-scrollbar -->
    <script src="{{asset('assets/plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.concat.min.js')}}" type="text/javascript"></script>
    <!-- sscroll -->
    <script src="{{asset('assets/plugins/simplebar/dist/simplebar.js')}}" type="text/javascript"></script>
    <!-- metismenu-master -->
    <script src="{{asset('assets/plugins/metismenu-master/dist/metisMenu.min.js')}}" type="text/javascript"></script>
    <!-- custom js -->
    <script src="{{asset('assets/dist/js/custom.js')}}" type="text/javascript"></script>
    <!-- End Core Plugins-->
    <!-- Start Theme label Script-->
    <!-- main js -->
    <script src="{{asset('assets/dist/js/main.js')}}" type="text/javascript"></script>
@show
@yield('scriptpage')
</body>
</html>
