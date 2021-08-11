@extends('layouts.dashboard')

@section('title', 'Advertising')


@section('content')

    <form action="{{ route('admin.advertise.update', $ads->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group mb-3">
            <label for="">Title:</label>
            <input type="text" name="title" value="{{old('title',$ads->title)}}" class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <p class="invalid-feedback">
                {{$message}}
            </p>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="">Photo:</label>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
            @error('photo')
            <p class="invalid-feedback">
                {{$message}}
            </p>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Update </button>
        </div>

    </form>

@endsection
