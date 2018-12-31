<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\Photo;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        
        return view('admin.users.index', compact('users'));
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
        
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        //User::create($request->all());
        //return redirect('/admin/users');
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        
        if($file = $request->file('photo_id')){
            $path = time().$file->getClientOriginalName();
            $file->move('images', $path);
            $photo = Photo::create(['path'=>$path]);
            $input['photo_id'] = $photo->id;
        }
        //dd($input);
        
        User::create($input);
        
        Session::flash('alert-success', 'The user has been updated.');
        
        return redirect('/admin/users');
    
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
        return view('admin.users.show');
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
        $user = User::findOrFail($id);
        
        $roles = Role::pluck('name', 'id')->all();
              
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        
        if($file = $request->file('photo_id')){
            $path = time().$file->getClientOriginalName();
            $file->move('images', $path);
            $photo = Photo::create(['path'=>$path]);
            $input['photo_id'] = $photo->id;
        }
       
        //dd($input);
        
        $user->update($input);
        
        Session::flash('alert-success', 'The user has been updated.');
        
        return redirect('/admin/users');
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
        $user = User::findOrFail($id);
        
        unlink(public_path() . $user->photo->path);
        
        $photo = Photo::where('id', $user->photo_id);
        
        $photo->delete();
        
        $user->delete();        
        
        Session::flash('alert-danger', 'The user has been deleted.');
        
        return redirect('/admin/users');
        
    }
}
