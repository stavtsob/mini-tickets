<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{

    function index()
    {
        return view('auth.create_user');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    function create(Request $request)
    {
        $data = $request->all();
        $this->validator($data)->validate();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'role'  => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        notify()->success("Successfully create user " . $data['username'] ." ⚡️");
        return view('auth.create_user', ['success'=>true,'user'=>$user]);
    }
}
