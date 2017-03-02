<?php

namespace App\Http\Controllers;

use App\Role;
use App\Photo;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Response;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $userData = $request->all();

        if ($file = $request->file('photo_id')) {
            $fileName = date('Y_m_d', time()) . '-' . $file->getClientOriginalName();
            $photo = new Photo();
            $photo->path = $fileName;
            $photo->save();
            $file->move('images', $photo->path);
            $userData['photo_id'] = $photo->id;
        }
        $userData['password'] = bcrypt($userData['password']);
        User::create($userData);

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $userData = $request->all();
        if ($file = $request->file('photo_id')) {
            if ($oldPhoto = $user->photo) {
                $oldPhoto->unlinkFileIfExist();
                $oldPhoto->delete();
            }
            $fileName = date('Y_m_d', time()) . '-' . $file->getClientOriginalName();
            $photo = new Photo();
            $photo->path = $fileName;
            $photo->save();
            $file->move('images', $photo->path);
            $userData['photo_id'] = $photo->id;
        }
        if ($userData['password'] == '') {
            unset($userData['password']);
        } else {
            $userData['password'] = bcrypt($userData['password']);
        }
        $user->update($userData);

        return redirect(route('users.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $photo = $user->photo;
        $photo->unlinkFileIfExist();
        $photo->delete();
        $userDelete = User::destroy($id);
        $json = Response::json($userDelete);

        return $json;

    }

}
