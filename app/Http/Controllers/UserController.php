<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return response()->json(array('success' => true, 'users' => $users));
    }

    public function store (Request $request) {
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['success' => '']);
    }

    public function show($id) {
        $user = User::findorfail($id);
        return response()->json(array('success' => true, 'user' => $user));
    } 
}
