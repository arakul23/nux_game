<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LinkIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->route('user');

        if (!$user->link_token || $request->query('link_id') !== $user->link_token) {
            abort(403, 'Invalid link');
        }

        if (!$user->link_expires_at || now()->greaterThan($user->link_expires_at)) {
            abort(403, 'Link expired');
        }

        return $next($request);
    }
}
