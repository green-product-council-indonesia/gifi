<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    use WithRateLimiting;
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $user = User::where('email', '=', $this->email)->first();
        $this->validate();

        try {
            $this->rateLimit(5);
            if ($user) {
                if (Hash::check($this->password, $user->password)) {
                    if (!Auth::attempt(['status' => 1, 'email' => $this->email, 'password' => $this->password], $this->remember)) {

                        $this->email = '';
                        $this->password = '';

                        $this->addError('status', 'Akun belum disetujui, Silahkan Hubungi Admin untuk melakukan proses aktivasi akun atau silahkan menunggu email konfirmasi dari kami melalui akun yang didaftarkan');
                    } else {
                        return redirect()->intended(route('home'));
                    }
                } else {
                    $this->password = '';
                    $this->addError('password', 'Password Salah');
                }
            } else {

                $this->email = '';
                $this->password = '';
                $this->addError('email', "User tidak terdaftar");

                return;
            }
        } catch (TooManyRequestsException $exception) {
            $this->password = '';
            $this->addError('status', "Slow down! Please wait another $exception->secondsUntilAvailable seconds to log in. Or Reset Your Password");

            return;
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }

    public function download()
    {
        return response()->download(storage_path('app/client-guide.pdf'));
    }
}
