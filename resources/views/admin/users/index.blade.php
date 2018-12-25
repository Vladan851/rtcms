@extends('layouts.admin.default')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">My Users</h1>
    </div>
</div>

<table class="table table-striped table-bordered table-hover">

    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>created_at</th>            
            <th>updated_at</th>
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