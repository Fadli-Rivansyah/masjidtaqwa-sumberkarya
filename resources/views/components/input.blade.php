<label for="{{$id}}" class="form-label fw-semibold">{{$slot}}</label>
<input type="{{$type}}" name="{{$name}}" placeholder="{{$placeholder}}"  value="{{$value}}" class="form-control @error($id) is-invalid @enderror" id="{{$id}}" onmouseover="this.style.border='1px solid #1DA599'" onmouseout="this.style.border='1px solid #ced4da'"/>
@error($id)
    <div class="invalid-feedback">{{$message}}</div>   
@enderror