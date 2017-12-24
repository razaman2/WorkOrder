<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    public function handle($request, Closure $next, $routeRoles = '')
    {
    	$userRoles = \Illuminate\Support\Facades\Auth::user()->roles()->get()->map(function($role){
    		return $role->role;
	    })->toArray();

    	preg_match_all('/\w+/', $routeRoles, $roles);

    	if(collect($roles[0])->first(function($role) use($userRoles) {
    		return in_array('super', $userRoles) || in_array($role,$userRoles);
	    })) {
		    return $next($request);
	    } else {
		    return response()->json(['error' => 'user does not have access to this route.']);
	    }
    }
}
