@extends('layouts.dashboard')

@section('title', 'Roles')




@section('content')

    <form action="{{ route('admin.roles.store') }}" method="post" enctype="multipart/form-data">
        @csrf


    <div class="form-group mb-3">
        <label for="">Name:</label>
        <input type="text" name="name" value="{{ old('name')}}" class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="">Abilities:</label>
            <div>
                @foreach(config('abilities') as $key => $label)
                    <div class="checkbox mb-1">
                    <label for="">
                        <input type="checkbox" name="abilities[]" value="{{$key}}">
                        {{$label}}
                    </label>
                    </div>
                @endforeach
            </div>
        @error('abilities')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
    </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Save </button>
        </div>



    </form>








@endsection
