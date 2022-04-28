<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\Mailer\Test\Constraint\EmailCount;

use function PHPUnit\Framework\throwException;

class RegisterController extends Controller
{
    public function __construct(Request $request)
    {
            $this->middleware('auth');
    }
    public function index()
    {
        $userLevels = UserLevel::get();

        return view('auth.register',[
            'userLevels' => $userLevels
        ]);
    }

    public function addUser(Request $request)
    {
            $this->validate($request,[
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'email' => ['required','email','unique:users,email'],
                'password' => [ Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols(),
                'required',
                'confirmed'],
                'level' => 'required'
            ]);
                User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_level_id' => $request->level
            ]);

            return redirect()->route('allUsers');

    }
}
