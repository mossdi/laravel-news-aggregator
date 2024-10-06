<?php

namespace App\Http\Middleware;

use App\Interfaces\IMustVerifyCode;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureCodeIsVerified
{
    /**
     * Specify the redirect route for the middleware.
     *
     * @param string $route
     * @return string
     */
    public static function redirectTo($route)
    {
        return static::class . ':' . $route;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|null $redirectToRoute
     * @return Response|RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (!$request->user() || ($request->user() instanceof IMustVerifyCode && !$request->user()->hasVerifiedCode())) {
            return $request->expectsJson()
                ? abort(403, 'Your account is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'telegram.verification.notice'));
        }

        return $next($request);
    }
}
