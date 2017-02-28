@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="title">Edit User</h1>
        <div class="col-sm-3">
            <img src="{{$user->photo? $user->photo->path :"http://placehold.it/200x200"}}" alt="" class="img-responsive img-rounded">
        </div>

        <div id="log-in-form" class="col-sm-9">

            {!! Form::model($user, [ 'method'=>'PATCH','action' => ['AdminUserController@update', $user->id], 'files'=>true]) !!}


            <div class="form-group">
                {!!  Form::label('name', 'Name: ') !!}
                {!!  Form::text('name', $user->name, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!!  Form::label('password', 'Password: ') !!}
                {!!  Form::password('password', ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!!  Form::label('email', 'Email ') !!}
                {!!  Form::text('email', null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!!  Form::label('role_id', 'Role: ') !!}
                {!!  Form::select('role_id', $roles, $user->role_id, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!!  Form::label('is_active', 'Status ') !!}
                {!!  Form::select('is_active', ['1' => 'Active', '0' => 'Not Active'], $user->is_active, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!!  Form::label('photo_id', 'Avatar') !!}
                {!!  Form::file('photo_id', null, ['class'=>'btn btn-success']) !!}
            </div>

            {!! Form::submit('Update User', ['class'=>'btn btn-success']) !!}


            {!! Form::close() !!}

            @include('includes.error')


        </div>

    </div>

@endsection