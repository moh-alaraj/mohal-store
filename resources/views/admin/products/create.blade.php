@extends('layouts.dashboard')

@section('title', 'Create Products')

@section('content')

    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.products._form', [
    'button_label' => 'Add'
])
    </form>

@endsection
