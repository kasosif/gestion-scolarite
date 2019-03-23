<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion Scolarite - Connexion</title>
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
<div class="container sign-cont animated zoomIn">
    <div class="row sign-row">
        <div class="sign-title">
            <h2 class="teal-text"><i class="fa fa-user-circle-o"></i></h2>
            <h2 class="teal-text">Gestion Scolarite</h2>
        </div>

        <form class="col s12" id="reg-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row sign-row">

                <div class="input-field col s12">
                    <input id="u_name" type="email"  name="email" value="{{ old('email') }}" class="validate {{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus>
                    <label for="u_name">{{ __('E-Mail Address') }}</label>
                </div>
            </div>
            <div class="row sign-row">
                <div class="input-field col s12">
                    <input name="password" id="password" type="password" class="validate {{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                    <label for="password">{{ __('Password') }}</label>
                </div>
            </div>
            @if (Route::has('password.request'))
                <div class="row sign-row">
                    <div class="input-field col s12 m-b-30">
                        <label class="pull-left">
                            <a class='pink-text' href="{{ route('password.request') }}">
                                <b>{{ __('Forgot Your Password?') }}</b>
                            </a>
                        </label>
                    </div>
                </div>
            @endif
            <div class="row sign-row">
                <div class="input-field col s6">
                    <div class="sign-confirm">
                        <input type="checkbox" id="sign-confirm" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                        <label for="sign-confirm">{{ __('Remember Me') }}</label>
                    </div>
                </div>
                <div class="input-field col s6">
                    <button class="btn btn-large btn-register waves-effect waves-light green" type="submit" name="action">Login
                        <i class="material-icons right">done_all</i>
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
        @if ($errors->has('notadmin'))
        iziToast.warning({
            title: 'Non Autorisé',
            message: '{{ $errors->first("notadmin") }}',
            position: 'topCenter'
        });
        @endif
        @if ($errors->has('password'))
        iziToast.warning({
            title: 'Non Autorisé',
            message: '{{ $errors->first("password") }}',
            position: 'topCenter'
        });
        @endif
        @if ($errors->has('email'))
        iziToast.warning({
            title: 'Non Autorisé',
            message: '{{ $errors->first("email") }}',
            position: 'topCenter'
        });
        @endif
        $('select').material_select();

    });
</script>
</body>

</html>
