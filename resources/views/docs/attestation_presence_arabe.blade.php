<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>شهادة حضور</title>
    <style>
        @font-face {
            font-family:"stc";
            src:url("{{ storage_path('fonts/stc-bold.ttf')}}") format('truetype');
        }
    </style>
</head>
<body style="background:transparent; font-family: 'stc';">
<div dir="rtl" lang="ar">
    <div dir="rtl" lang="ar" style="font-size:12px; display:inline-block; text-align:center;">
         رقم التسجيل بالإدارة X<br>
        <br>
    </div>
</div>
<div class="container" style="height: 100%; margin-top: 25px;">
    <div class=""  >
        <center lang="ar"><strong style="font-size: 28px; direction:rtl;">شهادة حضور <br><div style="direction:rtl; display:inline;">{{ $etudiant->classe->niveau->specialite->annee->nom }}</div></strong></center>
        <br>
        <p style="font-size: 20px;margin-right: 10%;" align="right" dir="rtl" lang="ar">&nbsp;&nbsp;&nbsp;  يشهد المدير العام <strong>للمعهد X  </strong> <br> أن الطالب(ة):</p>
        <p style="font-size: 16px;margin-right: 10%;" align="right" dir="rtl" lang="ar">
            &nbsp;&nbsp;&nbsp; الاسم :<strong> {{ $etudiant->nom_ar }}</strong>
        </p>
        <p style="font-size: 16px;margin-right: 10%;" align="right" dir="rtl" lang="ar">
            &nbsp;&nbsp;&nbsp; اللقب :<strong>{{ $etudiant->prenom_ar }}</strong>
        </p>
        <p style="font-size: 16px;margin-right: 10%;" align="right" dir="rtl" lang="ar">
            &nbsp;&nbsp;&nbsp; المولود(ة) في  :<strong>{{ date('d-m-Y', strtotime( $etudiant->date_naissance)) }} ب{{ $etudiant->lieu_naissance_ar }}</strong>
        </p>
        <p style="font-size: 16px;margin-right: 10%;" align="right" dir="rtl" lang="ar">
            &nbsp;&nbsp;&nbsp; صاحب(ة) بطاقة التعريف الوطنية  عدد :<strong>{{ $etudiant->cin }}</strong>
        </p>
        <p style="font-size: 16px;margin-right: 10%;" align="right" dir="rtl"  lang="ar">&nbsp;&nbsp;&nbsp;  مرسم(ة) بالاختصاص  <strong> {{ $etudiant->classe->niveau->specialite->nom_ar }} </strong> <strong>{{ $etudiant->classe->promotion }}0{{ $etudiant->classe->niveau->specialite->code }}{{ $etudiant->id  }}</strong> يزاول دراسته بانتظام بالاختصاص المذكور أعلاه وذلك لسنة الدراسية
            {{ $etudiant->classe->niveau->specialite->annee->nom_ar }}</p>
        <p style="font-size: 16px;margin-right: 10%;" align="right" dir="rtl"  lang="ar">سلمت هذه الشهادة للمعني(ة) بالأمر للإدلاء بها عند الطلب</p>
        <div align="left" >
            <div style="margin-left: 10%; display:inline-block; text-align:center;" dir="rtl" lang="ar">
                ، في {{date('d-m-Y', strtotime('today'))}}<br><br>
                عن المدير العام <br>X
            </div>
        </div>
    </div>
</div>

</body>

</html>
