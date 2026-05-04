<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsCustomer
{
    /**
     * Handle an incoming request.
     * Blocks admin users from accessing customer-only routes (cart, checkout, payment).
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->usertype === 'admin') {
            return redirect()->route('dashboard')->with('error', 'Admin tidak dapat mengakses halaman belanja.');
        }

        return $next($request);
    }
}
