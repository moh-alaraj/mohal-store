@extends('layouts.dashboard')

@section('title', 'Advertisings')


@section('content')

<div class="container">

    <div class="table-toolbar mb-3">
        <a href="{{ route('admin.advertise.create') }}" class="btn btn-info">Create</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Photo</th>
            <th>Created at</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($ads as $ad)
            <tr>
                <td>{{$ad->id}}</td>
                <td><a href="{{ route('admin.advertise.edit',$ad->id )}}">{{$ad->title}}</a></td>
                <td>
                    <img width="100" src="{{$ad->image_link}}" alt="">
                </td>
                <td>{{$ad->created_at}}</td>

                <td>
                    <form action="{{ route('admin.advertise.destroy', $ad->id) }}" method="post">
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

