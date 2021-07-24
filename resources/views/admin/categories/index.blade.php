@extends('layouts.dashboard')

@section('title', 'Categories List')

@section('content')

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">

    </head>
    <body>
    <div class="container">

        <div class="table-toolbar mb-3">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-info">Create</a>
        </div>

        <form action="{{ URL::current() }}" method="get" class="d-flex mb-4">
            <input type="text" name="name" class="form-control me-2" placeholder="Search by name">
            <select name="parent_id" class="form-control me-2">
                <option value="">All Categories</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-secondary">Filter</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent Name</th>
                    <th>Created at</th>
                    <th>Statues</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td><a href="{{ route('admin.categories.edit',$category->id )}}">{{$category->name}}</a></td>
                    <td>{{$category->parent->name}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->status}}</td>
                    <td>
                        @can('delete',$category)
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
    </body>
    </html>
    @endsection
