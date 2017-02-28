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
            <th>Photo</th>
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
                @if(isset($user->photo))
                    <td><img height="50" src="{{$user->photo->path}}" alt=""></td>
                @else
                    <td>No photo</td>
                @endif
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                @if(isset($user->created_at) && isset($user->updated_at))
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                @else
                    <td>Do not have info</td>
                    <td>Do not have info</td>
                @endif
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