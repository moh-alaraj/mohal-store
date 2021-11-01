@extends('layouts.dashboard')

@section('title', 'Stores List')

@section('content')

    <div class="container">

        <div class="table-toolbar mb-3">
            <a href="{{ route('admin.stores.create') }}" class="btn btn-info">Create</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Logo</th>
                    <th>Currency</th>
                    <th>Locale</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
            @foreach($stores as $store)
                <tr>
                    <td>{{$store->id}}</td>
                    <td><a href="{{ route('admin.stores.edit',$store->id )}}">{{$store->name}}</a></td>
                    <td><img height="150" width="150" src="{{$store->image_link}}" alt=""></td>
                    <td>{{$store->currency}}</td>
                    <td>{{$store->locale}}</td>
                    <td>{{$store->description}}</td>
                    <td>{{$store->status}}</td>
                    <td>{{$store->created_at}}</td>
                    <td>
                        <form action="{{ route('admin.stores.destroy', $store->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection
