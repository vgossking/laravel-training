<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::paginate(15);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id');
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        $userData = $request->except('photo_id');
        $userData['user_id'] = Auth::id();
        $post = Post::create($userData);
        if($file = $request->file('photo_id')){
            $fileName = date('Y_m_d', time()) . '-'.$post->id;
            $photo = Photo::create(['path'=>'posts/'.$fileName.'.jpg']);
            $file->move('images', $photo->path);
            $post->photo_id = $photo->id;
            $post->save();
        }
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        //
        $post = Post::findOrFail($id);
        $postData = $request->all();
        if($file = $request->file('photo_id')){
            if ($oldPhoto = $post->photo) {
                $oldPhoto->unlinkFileIfExist();
                $oldPhoto->delete();
            }
            $fileName = date('Y_m_d', time()) . '-'.$post->id;
            $photo = Photo::create(['path'=>'posts/'.$fileName.'.jpg']);
            $file->move('images', $photo->path);
            $postData['photo_id'] = $photo->id;
        }

        $post->update($postData);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        if($photo = $post->photo){
            $photo->unlinkFileIfExist();
            $photo->delete();
        }
        $postDelete = Post::destroy($id);
        $json = Response::json($postDelete);

        return $json;
    }
}
