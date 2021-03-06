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
            <tr id = "user-{{$user->id}}">
                <td class="user-id">{{$user->id}}</td>
                <td><img height = '50' src="{{$user->photo? $user->photo->path :"http://placehold.it/200x200"}}" alt=""></td>
                <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->role->name}}</td>
                <td>{{$user->created_at ? $user->created_at->diffForHumans(): "Do not have info"}}</td>
                <td>{{$user->updated_at ? $user->updated_at->diffForHumans(): "Do not have info"}}</td>
                <td>{{$user->is_active ? 'Active' : 'Not Active'}}</td>
                <td><button class="btn btn-danger btn-delete">Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links('vendor.pagination.bootstrap-4') }}
@endsection