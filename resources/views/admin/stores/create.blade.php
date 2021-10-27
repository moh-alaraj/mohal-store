@extends('layouts.dashboard')

@section('title', 'Create Store')

@section('content')

    <form action="{{ route('admin.stores.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.stores._form', [
    'button_label' => 'Add'
])
    </form>

@endsection
