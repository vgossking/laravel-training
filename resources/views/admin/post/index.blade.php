@extends('layouts.app')

@section('content')
    <div class="flt-left">
        <h1>All Posts</h1>
    </div>
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
          @if($posts)
              @foreach($posts as $post)
                  <tr>
                      <td>{{$post->id}}</td>
                      <td>None</td>
                      <td>{{$post->title}}</td>
                      <td>{{$post->body? $post->body : ""}}</td>
                      <td>none</td>
                      <td>none</td>
                      <td>{{$post->created_at ? $post->created_at->diffForHumans() : ""}}</td>
                      <td>{{$post->updated_at ? $post->updated_at->diffForHumans() : ""}}</td>
                  </tr>
              @endforeach
          @endif
          </tbody>
        </table>

@endsection