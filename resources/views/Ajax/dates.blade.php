
<div class="col-md-6">
    <div class="form-group">
        <label for="date_debut" class="">Date de debut</label>
        <input
            @if($emploi)
            min="{{date('Y-m-d', strtotime($emploi->date_fin))}}"
            @else
            min="{{date('Y-m-d', strtotime($annee->date_debut))}}"
            @endif
            max="{{date('Y-m-d', strtotime($annee->date_fin))}}" name="date_debut" id="date_debut" class="form-control" type="date" required>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="date_fin" class="">Date de fin</label>
        <input
            @if($emploi)
            min="{{date('Y-m-d', strtotime($emploi->date_fin))}}"
            @else
            min="{{date('Y-m-d', strtotime($annee->date_debut))}}"
            @endif
            max="{{date('Y-m-d', strtotime($annee->date_fin))}}"
            name="date_fin" id= "date_fin" class="form-control" type="date" required>
    </div>
</div>
