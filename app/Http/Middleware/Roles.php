<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class  Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::getFacadeRoot()->current()->uri();
        $route = explode('/', $routeName);
        $roleRoutes = Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toarray();

        if (auth()->check()) {
            if (!in_array($route[0], $roleRoutes)) {
                return $next($request);
            } else {
                if ($route[0] != auth()->user()->roles[0]->allowed_route) {
                    $path = $route[0] == auth()->user()->roles[0]->allowed_route ? $route[0].'.login' : '' . auth()->user()->roles[0]->allowed_route.'.index';
                    return redirect()->route($path);
                } else {
                    return $next($request);
                }
            }
        } else {
            $routeDestination = in_array($route[0], $roleRoutes) ? $route[0].'.login' : 'login';
            $path = $route[0] != '' ? $routeDestination : auth()->user()->roles[0]->allowed_route.'.index';
            return redirect()->route($path);
        }
    }

}
