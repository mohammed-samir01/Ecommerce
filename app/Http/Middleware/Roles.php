<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class Roles
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

        if (auth()->check()) {
            if (!in_array($route[0], $this->roleRoutes())) {
                return $next($request);
            } else {
                if ($route[0] != $this->userRoutes()) {
                    $path = $route[0] == $this->userRoutes() ? $route[0].'.login' : '' . $this->userRoutes().'.index';
                    return redirect()->route($path);
                } else {
                    return $next($request);
                }
            }
        } else {
            $routeDestination = in_array($route[0], $this->roleRoutes()) ? $route[0].'.login' : 'login';
            $path = $route[0] != '' ? $routeDestination : $this->userRoutes().'.index';
            return redirect()->route($path);
        }
    }

    protected function roleRoutes()
    {
        if (!Cache::has('role_routes')) {
            Cache::forever('role_routes', Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray());
        }
        return Cache::get('role_routes');
    }

    protected function userRoutes()
    {
        if (!Cache::has('user_routes')) {
            Cache::forever('user_routes', auth()->user()->roles[0]->allowed_route);
        }
        return Cache::get('user_routes');
    }
}
