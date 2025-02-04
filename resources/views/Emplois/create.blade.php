@extends('layouts.app')
@section('title')
    Ajouter un Emploi
@endsection
@section('csspage')
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2-bootstrap.css')}}">
    <!-- iziToast alert -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/iziToast/dist/css/iziToast.min.css')}}">
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
                        <form id="paramsform" action="" method="post">
                            @csrf
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
                                <button  id="validateparams" type="submit" class="btn btn-labeled btn-primary m-t-20">
                                    <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Valider
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="loader" style="display: none" class="text-center">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
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

                <div class="spinner-layer spinner-red">
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
                <div class="spinner-layer spinner-green">
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
        <div class="row" id="emploicontainer">

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
            Date.prototype.toInputFormat = function() {
                var yyyy = this.getFullYear().toString();
                var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
                var dd  = this.getDate().toString();
                return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
            };
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
            $('body').on('change','#date_debut',function () {
                var date = new Date($("#date_debut").val());

                if(!isNaN(date.getTime())){
                    date.setDate(date.getDate() + 5);

                    $("#date_fin").val(date.toInputFormat());
                } else {
                    alert("Invalid Date");
                }
            });
            $("#paramsform").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                $('#loader').show();
                var form = $(this);
                var url = '{{route('ajax.displayemploi')}}';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        $('#validateparams').remove();
                        $("#paramsform :input").prop("disabled", true);
                        $('#loader').hide();
                        $('#emploicontainer').html(data);
                        $('#emploicontainer').find('select').select2();
                        // show response from the php script.
                    },
                    error: function (data) {
                        iziToast.error({
                            title: 'Erreur',
                            message: data.responseText,
                            position: 'topCenter'
                        });
                    }
                });


            });

        });
    </script>
@endsection
