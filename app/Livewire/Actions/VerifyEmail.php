<?php

namespace App\Livewire\Actions;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmail
{
    /**
     * Handle email verification via signed URL.
     */
    public function __invoke(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user() ?: User::findOrFail($request->route('id'));

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException('Invalid verification link');
        }

        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
                ? response()->json([
                    'status' => true,
                    'message' => 'Email already verified'
                ], 200)
                : view('auth.verify', [
                    'status' => 'Email already verified'
                ]);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $request->wantsJson()
            ? response()->json([
                'status' => true,
                'message' => 'Email verified successfully'
            ], 200)
            : view('auth.verify', [
                'status' => 'Email verified successfully'
            ]);
    }
}
