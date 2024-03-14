<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserListController extends Controller
{
    function index(Request $request)
    {
        $users = User::all();
        return view('auth.list', ['users'=>$users]);
    }
}
