@for($i = 1; $i < $nb+1 ; $i++)
    <div class="partie{{$i}}">
        <div class="col-md-8">
            <div class="input-field form-input">
                <label for="titrepartie{{$i}}" class="">Titre</label>
                <input id="titrepartie{{$i}}" name="partie[{{$i}}][titre]" type="text" class="validate" required>
            </div>
            <div class="input-field form-input">
                <label for="videopartie{{$i}}" class="">Video</label>
                <input id="videopartie{{$i}}" name="partie[{{$i}}][video]" type="file" class="fileinput" required>
            </div>
        </div>
    </div>
@endfor
