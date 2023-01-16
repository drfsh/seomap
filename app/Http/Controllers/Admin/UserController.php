<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{

    public function view(){
        return Inertia::render('Admin/Users', [
            'users' => User::orderBy('id','desc')->paginate(10),
        ]);
    }

    public function create(){
        return Inertia::render('Admin/UserCreate');
    }

    public function store(Request $request){
        $name = $request->name;
        $mobile = $request->mobile;
        $email = $request->email;

        $password = $request->password;
        $user = new User();
        $user->name = $name;
        $user->mobile = $mobile;
        $user->email = $email;
        $user->password = Hash::make($password);

        if ($request->hasFile('profile')){
            $path = $this->upload($request->file('profile'));
            $user->profile = $path;
        }

        $user->save();

        return redirect()->intended(route('admin.users'));

    }


    public function edit($id){
        $user = User::find($id);
        if (!$user) abort(404);
        return Inertia::render('Admin/UserEdit',[
            'user'=> $user
        ]);
    }

    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        $mobile = $request->mobile;
        $email = $request->email;

        $password = $request->password;
        $user = User::find($id);
        $user->name = $name;
        $user->mobile = $mobile;
        $user->email = $email;
        $user->password = Hash::make($password);

        if ($request->hasFile('profile')){
            $path = $this->upload($request->file('profile'));
            $user->profile = $path;
        }

        $user->save();

        return redirect()->intended(route('admin.users'));

    }

    public function destroy(Request $request){
        $id = $request->id;
        $user = User::find($id);
        $user->delete();
        return redirect()->intended(route('admin.users'));
    }
}
