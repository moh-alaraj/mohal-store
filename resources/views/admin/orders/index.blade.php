@extends('layouts.dashboard')
@section('title', 'Orders')



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
            <th>Name</th>
            <th>Email</th>
            <th>Country Code</th>
            <th>City</th>
            <th>Phone Number</th>
            <th>Total</th>
            <th>Notes</th>
            <th>Status</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->first_name}}  {{$order->last_name}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->country_code}}</td>
                <td>{{$order->city}}</td>
                <td>{{$order->phone_number}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->notes ?? '-'}}</td>
                <td>{{$order->status}}</td>
                <td>{{$order->created_at}}</td>
            </tr>
        @endforeach


        </tbody>
    </table>
    {{ $orders->links('vendor.pagination.bootstrap-4')}}

</div>
</body>
</html>
@endsection
