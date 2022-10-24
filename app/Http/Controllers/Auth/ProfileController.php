<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    function index(Request $request, $userId = null)
    {
        return view('auth.profile', ['user'=>User::find($userId) ?? Auth::user()]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorForUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
        ]);
    }
    function update(Request $request, $userId)
    {
        $currentUser = Auth::user();

        // Check if user is permitted to change this user profile
        if($currentUser->id != $userId && $currentUser->role != 2)
        {
            abort(403,'You have not permission to do that.');
        }
        $data = $request->all();
        $this->validatorForUpdate($data)->validate();
        $user = User::where('id',$userId)->first();
        $result = User::where('id',$userId)
            ->update([
                'name' => $data['name'],
                'role'  => array_key_exists('role',$data) ? $data['role'] : $user->role,
            ]);
        notify()->success("Successfully updated user " . $user->username ." ⚡️");
        $route = route('users.profile') .'/'. $user->id;
        return redirect()->to($route);

    }

    function changePassword(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        if(!Hash::check($data['old-password'], $user->password))
        {
            notify()->error("Wrong password!");
            return redirect()->route('users.profile', ['user'=>$user]);
        }
        if($data['password'] != $data['password_confirmation'])
        {
            notify()->error("Password confirmation mismatch.");
            return redirect()->route('users.profile', $user->id);
        }

        User::where('id',$user->id)->update(['password'=>Hash::make($data['password'])]);

        notify()->success("Successfully updated password⚡️");
        return redirect()->route('users.profile', $user->id);
    }
}
