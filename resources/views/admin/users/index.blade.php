@extends('layouts.admin')

@section('content')

<h1>Users</h1>

<table border="2">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>CREATED</th>
            <th>UPDATED</th>
        </tr>
    </thead>
    <tbody>
        @if($users)
        
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>


@endsection