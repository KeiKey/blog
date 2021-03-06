<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @param  mixed    $roles
     * @return mixed | void
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        return redirect()->back()->with('no_access', 'Not Authorized!');
    }
}
