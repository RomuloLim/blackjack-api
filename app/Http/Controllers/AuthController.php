<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailException;
use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function store(AuthLoginRequest $request)
    {
       $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->delete();

        if(!$user->hasVerifiedEmail()) {
            throw ValidationException::withMessages([
                'email' => ['The provided email is not verified.'],
            ]);
        }

        return response()->json([
            'token' => $user->createToken('API Token', expiresAt: now()->addDay())->plainTextToken,
            'user' => $user,
        ]);
    }

    public function verifyEmail(Request $request, $id, $hash): RedirectResponse
    {
        $user = User::find($id);

        $shaEmail = sha1($user->getEmailForVerification());

        if ($hash !== $shaEmail) {
            throw EmailException::InvalidVerificationUrl();
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('home');
    }
}
