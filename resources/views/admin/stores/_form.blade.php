<div class="form-group mb-3">
    <label for="">Name:</label>
    <input type="text" name="name" value="{{ old('name',$stores->name)}}" class="form-control @error('name') is-invalid @enderror">
    @error('name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Description:</label>
    <input type="text" name="description" value="{{ old('description',$stores->description)}}" class="form-control @error('description') is-invalid @enderror">
    @error('description')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Logo:</label>
    <div class="container mb-3">
        <img  height="100" width="100" src="{{asset($stores->image_link)}}" alt="">
    </div>
    <input type="file" name="logo" class="form-control  @error('logo') is-invalid @enderror">
    @error('logo')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Currency</label>
    <input type="text" name="currency" value="{{ old('currency',$stores->currency)}}" class="form-control @error('currency') is-invalid @enderror">
    @error('currency')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Locale</label>
    <input type="text" name="locale" value="{{ old('locale',$stores->locale)}}" class="form-control @error('locale') is-invalid @enderror">
    @error('locale')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Status:</label>
    <div>
        <label><input type="radio" name="status" value="active" @if (old('status',$stores->status )== 'active') checked @endif>
            Active</label>
        <label><input type="radio" name="status" value="in-active" @if (old('status',$stores->status )== 'in-active') checked @endif>
            In-active</label>
        @error('status')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>



