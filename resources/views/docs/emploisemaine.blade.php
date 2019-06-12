<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>PDF</title>
    <link rel="icon" type="image/x-icon" href="{{public_path('assets/dist/img/ico/fav.png')}}" />
</head>
<body>
<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border:1px solid #424242;">
    <tr>
        <td rowspan="2" width="70" align="center" style="border-right:1px solid #424242;">
            <img src="{{public_path('image/logo-pdf.png') }}" width="90%" />
        </td>
        <td style="border-right:1px solid #424242;" align="center">Imprimée</td>
        <td style="border-right:1px solid #424242;" align="center"><center>IMP-{{date('d/m',strtotime('now'))}}</center></td>
        <td align="center"><center>00</center></td>
    </tr>
    <tr>
        <td style="border-right:1px solid #424242; border-top:1px solid #424242;" align="center"><strong>Programme Hebdomadaire</strong></td>
        <td colspan="2" width="20%" align="center" style="border-top:1px solid #424242;"><center>Date : {{date('d/m/Y',strtotime('now'))}}</center></td>
    </tr>
</table>
<br>
<p style="margin-bottom: 2%;margin-top: 2%;font-size: 14px;font-family: 'Times New Roman';font-weight: bold;">
    {{$titre_semaine}} : {{ $dateD->format('d-m-Y') }} au {{ $dateF->format('d-m-Y')  }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Classe: {{$classe->niveau->specialite->nom}} {{$classe->niveau->nom}} {{$classe->abbreviation}} ({{ $classe->promotion }} <sup>éme</sup> Promotion)
</p>
<br>
<table style="border: 1px #424242 solid;" border="0" cellspacing="0" cellpadding="0" width="100%">
    <thead>
    <tr style="">
        <td width="10%;" align="center" style="font-size: 12px; font-weight: bold;background-color: #a7a7a7; padding:6px 3px; border-bottom:1px #424242 solid;">Journée\Horaire</td>
        @foreach($seances as $s)
            <td align="center" width="22.5%" style="font-size: 12px; font-weight: bold;background-color: #a7a7a7; padding:6px 3px; border-left:1px #424242 solid; border-bottom:1px #424242 solid;">
                {{date('H:i', strtotime($s->heure_debut))}} => {{date('H:i', strtotime($s->heure_fin))}}
            </td>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($jours as $jour)
        <tr id="{{ $jour->jour_id }}">
            <td width="10%;" align="center" style="font-size: 12px; font-weight:bold; padding:6px 3px; border-bottom:1px #424242 solid; text-align:center;">{{ $jour->nom }}</td>
            @foreach($pagination as $ligne)
                @if($ligne->jour->id == $jour->id)
                    @if($ligne->matiere)
                        <td style="font-size: 12px; font-weight: bold; padding:6px 3px; border-left:1px #424242 solid; border-bottom:1px #424242 solid;" >
                            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td align="right" colspan="2">{{ $ligne->salle->id ? $ligne->salle->nom : 'none'}}</td>
                                </tr>
                                <tr>
                                    <td align="center" colspan="2">{{ $ligne->matiere->id ? $ligne->matiere->nom : 'none' }}</td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        @if($ligne->user->id && $ligne->user->gendre == 'male')
                                            Mr. {{ $ligne->user->id ? $ligne->user->nom : 'none' }} {{ $ligne->user->id ?$ligne->user->prenom : 'none' }}
                                        @else
                                            Mme. {{ $ligne->user->id ?$ligne->user->nom : 'none' }} {{$ligne->user->id ?$ligne->user->prenom  : 'none'}}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    @else
                        <td style="font-size: 12px; font-weight: bold; padding:6px 3px; border-left:1px #424242 solid; border-bottom:1px #424242 solid; background:#c5c5c5;"></td>
                    @endif
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:12px;">
<tr>
<td>
- <span style="font-weight: bold;">Destinataires :</span> DF, RF, RS,Formateurs, affichage.<br>
- <span style="font-weight: bold;">Copies :</span>Archives.
</td>
<td align="center">
</td>
<td align="right">
</td>
</tr>
<tr>
<td><br>
<center>
<span style="font-weight: bold; border-bottom:1px solid #424242; margin-bottom:3px; display:inline-block;">Chef Service Scolarité</span><br>
MR X </center>
</td>
<td align="center"><br>
<center>
<span style="font-weight: bold; border-bottom:1px solid #424242; margin-bottom:3px; display:inline-block;">Chargé de la Direction de la Formation</span><br>MR X</center>
</td>
<td align="right"><br>
<div style="display:inline-block; text-align:center;">
<span style="font-weight: bold; border-bottom:1px solid #424242; margin-bottom:3px; display:inline-block;">Directeur Général de l’IMFMM</span><br>
    MR X
</div>
</td>
</tr>
</table>
</body>
</html>
