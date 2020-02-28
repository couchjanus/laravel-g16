<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        
        if (!app()->runningInConsole() && $user) {
            $roles = Role::with('permissions')->get();
            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->slug][] = $role->id;
                }
            }
            foreach ($permissionsArray as $slug => $roles) {
                Gate::define($slug, function (\App\Admin $user) use ($roles) {
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }
        return $next($request);
    }
}
