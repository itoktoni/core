<?php

namespace App\Http\Middleware;

use App\Dao\Enums\Core\RoleLevel;
use App\Dao\Enums\Core\LevelType;
use Closure;
use Illuminate\Http\Request;

class DebugBarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        \Debugbar::disable();
        if(auth()->check() && auth()->user()->level == LevelType::Developer && env('DEBUGBAR_ENABLED')) {
            \Debugbar::enable();
        }
        return $next($request);
    }
}
