<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AutoCheckPermission
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
        $routeName = $request->route()->getName();
        $permission = Permission::whereRaw("FIND_IN_SET ('$routeName', routes)")->first();
        if(!$request->user()->hasRole('owner')){
        if ($permission) {
            if (!$request->user()->can($permission->name)) {
                abort(403);
            }
        }}elseif(!$request->user()->hasRole('owner')){
            abort(403);
        }

        return $next($request);
    }
}
