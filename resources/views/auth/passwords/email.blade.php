<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{asset('assets/dist/img/ico/fav.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Scolarite - Réinitialisation Mot de passe</title>
    <!-- Favicon and touch icons -->

    <!-- Start Global Mandatory Style
         =====================================================================-->
    <!-- Material Icons CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Animation Css -->
    <link href="{{asset('assets/plugins/animate/animate.css')}}" rel="stylesheet" />
    <!-- materialize css -->
    <link href="{{asset('assets/plugins/materialize/css/materialize.min.css')}}" rel="stylesheet">
    <!-- custom CSS -->
    <link href="{{asset('assets/dist/css/stylematerial.css')}}" rel="stylesheet">
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
</head>

<body class="sign-section">
<div class="container sign-cont animated bounceIn">
    <div class="row sign-row">
        <div class="sign-title text-center">
            <center><img src="{{asset('assets/dist/img/logo3.png')}}" alt="logo"></center>
            <h2 class="teal-text"><i class="fa fa-lock fa-4x"></i></h2>
            <h2 class="teal-text">Réinitialiser Mot de Passe</h2>
        </div>
        <form class="col s12" id="reg-form" method="post" action="{{ route('password.email') }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    <label for="email">Saisissez votre E-mail</label>
                </div>
            </div>
            <div class="row pull-right">
                <div class="input-field col s6">
                    <a href="{{route('login')}}" class="btn btn-large btn-danger" style="background: red">
                        Retour
                    </a>
                </div>
                <div class="input-field col s6">
                    <button class="btn btn-large btn-register waves-effect waves-light teal" type="submit" name="action">Réinitialiser
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Start Core Plugins
     =====================================================================-->
<!-- jQuery -->
<script src="{{asset('assets/plugins/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<!-- materialize  -->
<script src="{{asset('assets/plugins/materialize/js/materialize.min.js')}}" type="text/javascript"></script>
<!-- iziToast -->
<script src="{{asset('assets/plugins/iziToast/dist/js/iziToast.min.js')}}" type="text/javascript"></script>
<!-- End Core Plugins
     =====================================================================-->
<script>
    $(document).ready(function() {
        @if ($errors->has('email'))
        iziToast.warning({
            title: 'Non Autorisé',
            message: '{{ $errors->first("email") }}',
            position: 'topCenter'
        });
        @endif
        @if (session('status'))
        iziToast.success({
            title: 'Succees',
            message: '{{ session('status') }}',
            position: 'topCenter'
        });
        @endif
        $('select').material_select();

    });
</script>
</body>

</html>
