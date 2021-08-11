@extends('layouts.dashboard')

@section('title', 'Advertisings')


@section('content')

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('pannelassets/css/bootstrap.min.css')}}">

</head>
<body>
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
</body>
</html>
@endsection

