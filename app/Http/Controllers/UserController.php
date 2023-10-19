<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'desc')->get();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create(){

        return view('users.manage');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6',
            // 'password_confirmation' => 'required|same:password',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('adminusers.index')->with('success', 'User created successfully.');

    }

    public function edit($id){

        $user = User::find($id);

        return view('users.manage',[
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'phone' => 'required|unique:users,phone,'.$id,
            'password' => 'nullable|min:6',
            // 'password_confirmation' => 'required|same:password',
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if($request-> password){

            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('adminusers.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id){

        $user = User::find($id);

        $user->delete();

        return redirect()->route('adminusers.index')->with('success', 'User deleted successfully.');
    }
}
