@extends('layouts.dashboard')

@section('title', 'Create Categories')

@section('content')

    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.categories._form', [
    'button_label' => 'Add'
])
    </form>

{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Document</title>--}}
{{--    <link rel="stylesheet" href="/css/bootstrap.min.css">--}}

{{--</head>--}}
{{--<body>--}}
{{--<div class="container">--}}
{{--    <h1> Add Category</h1>--}}
{{--        <div>--}}
{{--            <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="Name:"></label>--}}
{{--                    <input type="text" name="name">--}}
{{--                </div>--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="Parent:"></label>--}}
{{--                        <select name="parent_id" >--}}
{{--                            <option value="">No parent</option>--}}
{{--                            @foreach ($parents as $parent)--}}
{{--                                <option value="{{$parent->id}}">{{$parent->name}}</option>--}}
{{--                           @endforeach--}}

{{--                        </select>--}}
{{--                </div>--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="Description:"></label>--}}
{{--                    <textarea name="description" ></textarea>--}}
{{--                </div>--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="Status:"></label>--}}

{{--                    <div class="form-group mb-3">--}}

{{--                      <label><input type="radio" name="status" value="active"> Active </label>--}}
{{--                              <label><input type="radio" name="status" value="inactive"> InActive </label>--}}


{{--                    </div>--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <button type="submit">Add</button>--}}
{{--                </div>--}}

{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
@endsection
