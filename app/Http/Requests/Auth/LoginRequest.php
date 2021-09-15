<?php

namespace App\Http\Requests\Auth;

use App\Models\Info\UserAttr;
use App\Rules\Traits\UserReglas;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    use UserReglas;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            UserAttr::USERNAME => $this->usernameRules(),
            UserAttr::PASSWORD => $this->passwordReglas(),
        ];
    }

    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only(UserAttr::USERNAME, UserAttr::PASSWORD))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                UserAttr::USERNAME => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            UserAttr::USERNAME => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey()
    {
        return Str::lower($this->input(UserAttr::USERNAME)) . '|' . $this->ip();
    }
}
