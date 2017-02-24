@extends('layouts.app')
@section('content')
    <div class="flt-left">
        <h1>All Users</h1>
    </div>

    <div class="flt-right mg-top-20">
        <a href="{{url('/admin/users/create')}}" class="btn btn-info">Add User</a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>{{$user->updated_at->diffForHumans()}}</td>
                @if($user->is_active)
                    <td>Activated</td>
                @else
                    <td>Not Activated</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection