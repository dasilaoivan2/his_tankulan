<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if($role == 'Admin' && auth()->user()->userrole_id != 1)
        {
            abort(403, 'Accessed Denied');
            
        }
        if($role == 'Encoder' && auth()->user()->userrole_id != 2)
        {
            abort(403, 'Accessed Denied');
        }

        return $next($request);
    }
}
