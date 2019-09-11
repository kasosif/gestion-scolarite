<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Attestation de présence</title>


</head>
<body style="background:transparent; position:relative;">
<div class="container" style="position:relative; margin-top: 25px;">
    <div>
        <center><strong style="font-weight: bold; font-size: 24px;">Attestation de présence <br>{{ $etudiant->classe->niveau->specialite->annee->nom }}</strong></center>
        <br>
        <p>Le Directeur Général de l’Institut X atteste que l'etudiant(e):</p>
        <p>Nom : <strong>{{ $etudiant->nom }}</strong></p>
        <p>Prénom : <strong>{{ $etudiant->prenom }}</strong></p>
        <p>Né(e) le : <strong>{{date('d-m-Y', strtotime( $etudiant->date_naissance))}} à {{ $etudiant->lieu_naissance }}</strong></p>
        <p>Titulaire de la CIN N° : <strong>{{ $etudiant->cin }}</strong><br>
        <p>Inscrit(e) dans la spécialité <strong>{{ $etudiant->classe->niveau->specialite->nom }} </strong> sous le numéro <strong>{{ $etudiant->classe->promotion }}0{{ $etudiant->classe->niveau->specialite->code }}{{ $etudiant->id  }}</strong>,
            poursuit les cours dans la spécialité citée ci-dessus et ce au titre de l’année scolaire {{ $etudiant->classe->niveau->specialite->annee->nom }}.
        </p>
        <p>
            Cette attestation est délivrée à l’intéressé(e) pour servir et valoir ce que droit.
        </p>
        <br>
        <br>
        <div align="right">
            Le {{date('d-m-Y', strtotime('today'))}}<br>
            Le Directeur Général
            X
        </div>
    </div>
</div>
</body>
</html>
