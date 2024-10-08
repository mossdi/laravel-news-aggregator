<?php

namespace App\Http\Controllers\WebAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AccountVerificationNotificationController extends Controller
{
    /**
     * Send a new code verification notification.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedCode()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendCodeNotification();

        return back()->with('status', 'verification-code-sent');
    }
}
