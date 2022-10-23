<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index ()
    {
        return view('admin.user.user-data', [
            'user' => User::class
        ]);
    }

    public function edit ($user_id)
    {
        $user_id = id_dec($user_id,'user');
        return view('admin.user.user-edit', compact('user_id'));
    }
}
