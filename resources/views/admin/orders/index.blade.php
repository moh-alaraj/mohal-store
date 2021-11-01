@extends('layouts.dashboard')
@section('title', 'Orders')



@section('content')
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

@endsection
