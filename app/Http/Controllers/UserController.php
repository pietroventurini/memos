<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    /**
     * Return user information from its id or from its email querystring parameters
     */
    public function getUserByIdOrEmail(Request $request) {
        if ($request->filled('id')) {
            $user_id = $request->query('id');
            $user = User::find($user_id);
        } else if ($request->filled('email')) {
            $email = $request->query('email');
            $user = User::where('email','=', $email)->first();
        } else {
            return response()->json(['message'=>'Bad request'], 400);
        }

        if (!($user === null))
            return response()->json(['user' => $user]);
        return response()->json(['message' => 'User not Found!'], 404);
    }

    /**
     * Return user from its id
     */
    public function show($user_id) {
        $user = User::find($user_id);
        if (!($user === null))
            return response()->json(['user' => $user]);
        return response()->json(['message' => 'User not Found!'], 404);
    }
}
