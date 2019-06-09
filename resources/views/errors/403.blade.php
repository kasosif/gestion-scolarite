<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Non Autorisé</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{asset('assets/dist/img/ico/fav.png')}}">
    <!-- Start Global Mandatory Style
       =====================================================================-->
    <link href="https://fonts.googleapis.com/css?family=Trocchi" rel="stylesheet">
    <!-- materialize css -->
    <link href="{{asset('assets/plugins/materialize/css/materialize.min.css')}}" rel="stylesheet">
    <!-- Bootstrap css-->
    <link href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Icons CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Animation Css -->
    <link href="{{asset('assets/plugins/animate/animate.css')}}" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- custom CSS -->
    <link href="{{asset('assets/dist/css/stylematerial.css')}}" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- row -->
    <div class="row">
        <!-- 403 Eror page -->
        <a href="{{route('home')}}" class="btn btn-hm m-t-10"><i class="fa fa-home fa-lg"></i> Tableau de Board</a>
        <div id="error" style="color: #ff155e">
            <div class="animated bounceIn opps"><i class="fa fa-warning fa-3x"></i></div>
            <div class="animated bounceIn opps">
                <p>Oops!</p>
            </div>
            <div id="err" class="animated bounceIn">
                <p>403</p>
            </div>
            <div id="er" class="animated bounceIn">
                <p>Désolé, Vous n'etes pas autorisé a acceder a cette page/action</p>
            </div>
        </div>
        <!-- ./403 Eror page -->
    </div>
    <!-- ./row -->
</div>
<!-- Start Core Plugins
   =====================================================================-->
<!-- jQuery -->
<script src="{{asset('assets/plugins/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- materialize  -->
<script src="{{asset('assets/plugins/materialize/js/materialize.min.js')}}" type="text/javascript"></script>
<!-- End Core Plugins-->
</body>
</html>

