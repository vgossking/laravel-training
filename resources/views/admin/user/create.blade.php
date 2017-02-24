@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div id="log-in-form">
            <h1>Create User</h1>
            {!! Form::open(['action' => 'AdminUserController@store', 'method'=>'POST']) !!}


            <div class="form-group">
                {!!  Form::label('name', 'Name: ') !!}
                {!!  Form::text('name', null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!!  Form::label('Email', 'Email ') !!}
                {!!  Form::text('Email', null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!!  Form::label('role', 'Role: ') !!}
                {!!  Form::select('role', ['L' => 'Large', 'S' => 'Small'], null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!!  Form::checkbox('is_active', '1') !!}
                {!!  Form::label('status', 'Activate ') !!}
            </div>

            {!! Form::submit('Add User', ['class'=>'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>

    </div>

@endsection