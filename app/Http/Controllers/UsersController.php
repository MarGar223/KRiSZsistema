<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    public function index(Request $request) {
        $users = User::orderBy('name', 'asc')->paginate(15);
        $uri = $request->path();

        return view('Auth.users', [
            'users' => $users,
            'uri' => $uri
        ]);
    }
    public function editUserView(User $user){
        $userLevels = UserLevel::get();
        return view('Auth.editUser', [
            'user' => $user,
            'userLevels' => $userLevels
        ]);
    }

    public function editUser(Request $request, User $user){

        $this->validate($request,[
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'role' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
            'level' => 'required'
        ]);

        $request->user()->where('id', $user->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level
        ]);

        return redirect()->route('allUsers');
    }

    public function deleteUser(Request $request, User $user){

        if($user->level != 'Administratorius'){
            $request->user()->where('id', $user->id)->delete();
        }

        return redirect()->route('allUsers');
    }
}
