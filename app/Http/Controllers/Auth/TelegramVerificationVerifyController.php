<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TelegramCodeVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class TelegramVerificationVerifyController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(TelegramCodeVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedCode()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        if ($request->user()->verifyCode($request->get('code'))) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
