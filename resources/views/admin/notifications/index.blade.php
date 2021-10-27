@extends('layouts.dashboard')
@section('title', 'Notifications')



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

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Notifiable ID</th>
            <th>Data</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notifications as $notification)
            <tr>
                <td>{{$notification->id}}</td>
                <td>{{$notification->notifiable_id}}</td>
                <td>{{data_get(json_decode($notification->data), 'title')}}</td>
                <td>{{$notification->created_at}}</td>
            </tr>
        @endforeach


        </tbody>
    </table>
    {{ $notifications->links('vendor.pagination.bootstrap-4')}}

</div>
</body>
</html>
@endsection
