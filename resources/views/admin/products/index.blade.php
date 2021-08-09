@extends('layouts.dashboard')

@section('title', 'Products List')

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
            <a href="{{ route('admin.products.create') }}" class="btn btn-info">Create</a>
        </div>

        <form action="{{ URL::current() }}" method="get" class="d-flex mb-4">
            <input type="text" name="name" class="form-control me-2" placeholder="Search by name">
            <select name="parent_id" class="form-control me-2">
                <option value="">All Products</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-secondary">Filter</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category Name</th>
                    <th>Store Name</th>
{{--                    <th>Description</th>--}}
                    <th>Price</th>
                    <th>Image</th>
                    <th>Sale Price</th>
                    <th>Quantity</th>
                    <th>Statues</th>
                    <th>Created at</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td><a href="{{ route('admin.products.edit',$product->id )}}">{{$product->name}}</a></td>
                    <td>{{$product->category->name}}</td>
                    <td>{{$product->store->name}}</td>
{{--                    <td>{{$product->description}}</td>--}}
                    <td>{{$product->price}}</td>
                    <td><img height="150" width="150" src="{{$product->image_link}}" alt=""></td>
                    <td>{{$product->sale_price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->status}}</td>
                    <td>{{$product->created_at}}</td>

                    <td>
                        @can('delete',$product)
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
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
        {{ $products->links('vendor.pagination.bootstrap-4')}}
    </div>
    </body>
    </html>
    @endsection
