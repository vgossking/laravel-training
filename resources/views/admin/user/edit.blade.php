@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div id="log-in-form">
            <h1>Edit User</h1>
            {!! Form::model($user,['action' => 'AdminUserController@update', 'method'=>'POST', 'files'=>true]) !!}


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
                {!!  Form::select('role_id', [], null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!!  Form::label('is_active', 'Status ') !!}
                {!!  Form::select('is_active', ['1' => 'Active', '0' => 'Not Active'], null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!!  Form::label('photo_id', 'Avatar') !!}
                {!!  Form::file('photo_id', null, ['class'=>'btn btn-success']) !!}
            </div>

            {!! Form::submit('Add User', ['class'=>'btn btn-success']) !!}


            {!! Form::close() !!}

            @include('includes.error')


        </div>

    </div>

@endsection