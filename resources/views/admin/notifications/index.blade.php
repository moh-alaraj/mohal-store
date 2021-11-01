@extends('layouts.dashboard')

@section('title', 'Notifications')



@section('content')

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

@endsection
