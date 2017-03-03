@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="title">Edit Post</h1>
        <div class="col-sm-3">
            <img src="{{$post->photo? $post->photo->path :"http://placehold.it/200x200"}}" alt="" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
            {!! Form::model($post, [ 'method'=>'PATCH','action' => ['AdminPostsController@update', $post->id], 'files'=>true]) !!}


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
                {!!  Form::label('category_id', 'Category: ') !!}
                {!!  Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
            </div>


            {!! Form::submit('Update User', ['class'=>'btn btn-success']) !!}


            {!! Form::close() !!}

            @include('includes.error')
        </div>

    </div>

@endsection