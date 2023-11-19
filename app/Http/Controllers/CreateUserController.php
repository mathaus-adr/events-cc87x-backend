<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CreateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'name' => 'string|required'
            ]
        );

        return User::create($validated);
    }
}
