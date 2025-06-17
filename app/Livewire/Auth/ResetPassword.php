<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ResetPassword extends Component
{
    public $email, $password, $password_confirmation, $token;

    protected function rules()
    {
        return [
            'token' => 'required',
            'password' => [
                'required',
                'confirmed',
                RulesPassword::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),
            ],
        ];
    }

    public function mount(Request $request)
    {
        $this->token = $request->query('token');
        $this->email = $request->query('email');
    }

    public function resetPassword()
    {
        try {
            $decryptedEmail = decrypt($this->email);
        } catch (\Exception $e) {
            $this->addError('email', 'Invalid or expired reset link.');
            return;
        }

        $this->validate();

        $status = Password::reset(
            [
                'email' => $decryptedEmail,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function (User $user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            session()->flash('status', 'Your password has been reset!');
        } elseif ($status == Password::INVALID_TOKEN) {
            $this->addError('email', 'The provided token is invalid.');
        } else {
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        /** @disregard @phpstan-ignore-line */
        return view('livewire.auth.reset-password')
            ->extends('layouts.guest')
            ->section('content');
    }
}
