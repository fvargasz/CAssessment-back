<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Pest\Laravel\json;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        //
        if (!$request->has('name') || empty($request->name)) {
            return response()->json(['error' => 'name field is required'], 400);
        }

        if (!$request->has('password') || empty($request->password)) {
            return response()->json(['error' => 'password field is required'], 400);
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email ?? 'default@example.com';
            $user->password = bcrypt($request->password); 
            $user->save();

            return response()->json([
                'message' => 'User created successfully',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create user',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}