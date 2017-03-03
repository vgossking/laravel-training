@extends('layouts.app')

@section('content')
    <div class=" container-fluid">
        <div class="flt-left">
            <h1>All Posts</h1>
        </div>
        @if($posts)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                </thead>
                <tbody>

                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><img height = '50' src="{{$post->photo? $post->photo->path :"http://placehold.it/200x200"}}" alt=""></td>
                        <td>{{$post->title}}</td>
                        <td>
                            <div class="tbl-cel">{{$post->body? $post->body : ""}}</div>
                        </td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->category? $post->category->name : 'Unknown category'}}</td>
                        <td>{{$post->created_at ? $post->created_at->diffForHumans() : ""}}</td>
                        <td>{{$post->updated_at ? $post->updated_at->diffForHumans() : ""}}</td>
                    </tr>
                @endforeach
                @else
                    <div class="alert alert-info clear-both" >No Posts Found</div>
                @endif
                </tbody>
            </table>
    </div>


@endsection