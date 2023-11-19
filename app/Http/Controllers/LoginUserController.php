<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUserController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws ValidationException
     */
    public function __invoke(Request $request): array
    {
        $validated = $request->validate(['email' => 'required|email', 'password' => 'required|string']);
        /** @var User $user */
        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return ['token' => $user->createToken('test')->plainTextToken];
    }
}
