<div class="form-group mb-3">
    <label for="">Name:</label>
    <input type="text" name="name" value="{{ old('name',$products->name)}}" class="form-control @error('name') is-invalid @enderror">
    @error('name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror

</div>
<div class="form-group mb-3">
    <label for="">Category Id:</label>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                    @if($category->id == old('category_id',$products->category_id)) selected @endif>{{$category->name}}</option>
        @endforeach
    </select>
    @error('category_id')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Store Id:</label>
    <select name="store_id" class="form-control @error('store_id') is-invalid @enderror">
        <option value="">Select Store</option>
        @foreach ($stores as $store)
            <option value="{{ $store->id }}"
                    @if($store->id == old('store_id',$products->store_id)) selected @endif>{{$store->name}}</option>
        @endforeach
    </select>
    @error('category_id')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Description:</label>
    <textarea name="description" class="form-control  @error('description') is-invalid @enderror">{{ old('description',$products->description)  }}</textarea>
    @error('description')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Image:</label>
    <div class="container mb-3">
            <img  height="100" width="100" src="{{asset($products->image_link)}}" alt="">
    </div>
    <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">
    @error('image')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Gallery:</label>
    <div class="container mb-3">
        @foreach($products->images as $image)
        <img  height="100" width="100" src="{{$image->image_link}}" alt="">
        @endforeach
    </div>
    <input type="file" name="gallery[]" multiple class="form-control  @error('gallery') is-invalid @enderror">
    @error('gallery')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Price:</label>
    <input type="number" name="price" value="{{ old('price',$products->price)}}" class="form-control @error('price') is-invalid @enderror">
    @error('price')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror

</div>
<div class="form-group mb-3">
    <label for="">Sale Price:</label>
    <input type="number" name="sale_price" value="{{ old('sale_price',$products->sale_price)}}" class="form-control @error('sale_price') is-invalid @enderror">
    @error('sale_price')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror

</div>
<div class="form-group mb-3">
    <label for="">Quantity:</label>
    <input type="number" name="quantity" value="{{ old('quantity',$products->quantity)}}" class="form-control @error('quantity') is-invalid @enderror">
    @error('quantity')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror

</div>
<div class="form-group mb-3">
    <label for="">Tags:</label>
    <input type="text" name="tags" value="{{ old('tags',$tags)}}" class=" tags form-control @error('tags') is-invalid @enderror">
    @error('tags')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror

</div>
<div class="form-group mb-3">
    <label for="">Status:</label>
    <div>
        <label><input type="radio" name="status" value="in-stock" @if (old('status',$products->status )== 'active') checked @endif>
            In-stock</label>
        <label><input type="radio" name="status" value="sold-out" @if (old('status',$products->status )== 'sold-out') checked @endif>
            Sold-out</label>
        <label><input type="radio" name="status" value="draft" @if (old('status',$products->status )== 'draft') checked @endif>
            Draft</label>
        @error('status')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>


@push('css')
    <link rel="stylesheet" href="{{asset('js/tagify/tagify.css')}}">
@endpush

@push('js')
    <script src="{{asset('js/tagify/tagify.min.js')}}"></script>
    <script>
        var inputElm = document.querySelector('.tags'),
            tagify = new Tagify (inputElm);
    </script>
@endpush

