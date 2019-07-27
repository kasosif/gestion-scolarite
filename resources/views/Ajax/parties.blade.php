@for($i = 1; $i < $nb+1 ; $i++)
    <div class="partie{{$i}}">
        <div class="col-md-8">
            <div class="input-field form-input">
                <input id="titrepartie{{$i}}" name="partie[{{$i}}][titre]" type="text" class="validate" required>
                <label for="titrepartie{{$i}}" class="">Titre</label>
            </div>
            <div class="input-field form-input">
                <input id="videopartie{{$i}}" name="partie[{{$i}}][video]" type="file" class="fileinput" required>
                <label for="videopartie{{$i}}" class="">Video</label>
            </div>
        </div>
    </div>
@endfor
