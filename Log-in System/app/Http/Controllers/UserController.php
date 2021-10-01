<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    //

    public function index()
    {
        $users=User::all();
        return view('admin.users.index',['users'=>$users]);
    }

    public function show(User $user)
    {
        return view('admin.users.profile',
        [
           'user'=>$user,
           'roles'=>Role::all()
          
        ]);
    }

    public function update(User $user)
    {
        $inputs =  request()->validate(
        [
            'username'=>['required','string','max:255'],
            'name'=>['required','string','max:255'],
            'email'=>['required','max:255'],
            'avatar'=>['file'],
            'password'=>['min:6','max:255']
        ]);


        if(request('avatar'))
        {
            // dd(request('avatar'));
            $inputs['avatar'] = request('avatar')->store('images'); // storing the image in Storage/images direcotry
        }
        $user->update($inputs);

        return back();
    }

    public function attach(User $user)
    {
          $user->roles()->attach(request('role'));
          return back();
    }

    public function detach(User $user)
    {
          $user->roles()->detach(request('role'));
          return back();
    }


    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('user-deleted', 'user has been deleted');
        return back();

    }
}
