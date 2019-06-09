<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Carte Etudiant</title>
    <link rel="icon" type="image/x-icon" href="{{ public_path('favicon.ico')}}" />
</head>
<body>
<center>
    <div  style="border:2px solid #000; padding:10px; height:230px; width:410px; margin-left:-8px;">
        <div style="width:25%; float:left; margin-top:5px;">
            <img src="{{public_path('assets/dist/img/logo-pdf.png')}}" height="50" />
        </div>
        <div style="width:50%; float:left; margin-top:5px;">
            <strong align="center"><h3 class="pull-left" style="color: black;margin-left: 0%;font-size: 15px;">Carte Etudiant <br>{{ $etudiant->classe->niveau->specialite->annee->nom }}</h3></strong>
        </div>
        <div style="width:25%; float:left; text-align:right; margin-top:5px;">
            <img @if($etudiant->image)
                 src="{{public_path('images/etudiants/'.$etudiant->image)}}"
                 @elseif($etudiant->gendre == 'female')
                 src="{{public_path('assets/dist/img/avatar2.png')}}"
                 @elseif($etudiant->gendre == 'male')
                 src="{{public_path('assets/dist/img/avatar5.png')}}"
                 @endif
                 width="60px;" height="75px;">
        </div>

        <div class="col-sm-12" style="margin-left: 0%;margin-top: 10%;">
            <p  style="color: black;font-family: 'Times New Roman';font-size: 11px;"><strong>Nom et Prénom :</strong>{{ $etudiant->prenom }} {{ $etudiant->nom }}</p>
            <p  style="color: black;font-family: 'Times New Roman';font-size: 11px;"><strong>Date et Lieu de Naissance : </strong>{{date('D,M Y', strtotime( $etudiant->date_naissance))}} à {{ $etudiant->lieu_naissance }}</p>
            <p  style="color: black;font-family: 'Times New Roman';font-size: 11px;"><strong>N° CIN :</strong>{{ $etudiant->cin }}</p>

            <p  style="color: black;font-family: 'Times New Roman';font-size: 11px;"><strong>Matricule :</strong>{{ $etudiant->classe->promotion }}0{{ $etudiant->classe->niveau->specialite->code }}{{ $etudiant->id  }}</p>
            <p  style="color: black;font-family: 'Times New Roman';font-size: 11px;"><strong>Spécialité :</strong>{{ $etudiant->classe->niveau->specialite->nom }}</p>
            <p  style="color: black;font-family: 'Times New Roman';font-size: 11px;"><strong>Classe :</strong>{{ $etudiant->classe->niveau->nom }} {{$etudiant->classe->abbreviation}}</p>

        </div>
    </div>
</center>
</body>

</html>
