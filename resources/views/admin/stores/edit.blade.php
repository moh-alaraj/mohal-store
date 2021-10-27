@extends('layouts.dashboard')

@section('title', 'Edit Store')

@section('content')

    <form action="{{ route('admin.stores.update',$stores->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('admin.stores._form', [
            'button_label' => 'Update'
        ])
    </form>

@endsection
