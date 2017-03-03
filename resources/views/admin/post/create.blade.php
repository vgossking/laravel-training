@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="flt-left">
            <h1>Add Post</h1>
        </div>
        <div class="clear-both">
            {!! Form::open(['action' => 'AdminPostsController@store', 'files' => true]) !!}


            <div class="form-group">
                {!!  Form::label('title', 'Title: ') !!}
                {!!  Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!!  Form::label('photo_id', 'Photo: ') !!}
                {!!  Form::file('photo_id') !!}
            </div>



            <div class="form-group">
                {!!  Form::label('body', 'Content: ') !!}
                {!!  Form::textarea('body', null, ['class' => 'form-control', 'size' => '30x20']) !!}
            </div>

            <div class="form-group">
                {!!  Form::label('category_id', 'Content: ') !!}
                {!!  Form::select('category_id', array(''=>'Choose Category'), null, ['class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Create Post', ['class'=>'btn btn-success']) !!}


            {!! Form::close() !!}
        </div>
    </div>


@endsection