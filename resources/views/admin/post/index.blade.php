@extends('layouts.app')

@section('content')
    <div class=" container-fluid">
        <div class="flt-left">
            <h1>All Posts</h1>
        </div>
        @if($posts->count() > 0)
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
                    <tr id="post-{{$post->id}}">
                        <td class="post-id">{{$post->id}}</td>
                        <td><img height = '50' src="{{$post->photo? $post->photo->path :"http://placehold.it/200x200"}}" alt=""></td>
                        <td><a href="{{url(route('posts.edit', $post->id))}}">{{$post->title}}</a></td>
                        <td>
                            <div class="tbl-cel">{{$post->body ? $post->body : ""}}</div>
                        </td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->category ? $post->category->name : 'Unknown category'}}</td>
                        <td>{{$post->created_at ? $post->created_at->diffForHumans() : ""}}</td>
                        <td>{{$post->updated_at ? $post->updated_at->diffForHumans() : ""}}</td>
                        <td><td><button class="btn btn-danger btn-post-delete">Delete</button></td></td>
                    </tr>
                @endforeach
                @else
                    <div class="alert alert-info clear-both" >No Posts Found</div>
                @endif
                </tbody>
            </table>
    </div>


@endsection