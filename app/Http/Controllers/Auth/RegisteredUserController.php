<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\TelegramApiKeyIsNull;
use App\Exceptions\TelegramChatIdIsNull;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param RegisterUserRequest $request
     * @return RedirectResponse
     * @throws TelegramApiKeyIsNull
     * @throws TelegramChatIdIsNull
     */
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->sendCodeNotification(8);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
