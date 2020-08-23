<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfAdminOfGroup
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
        $group_id = $request->route('group');
        if(!$request->user()->isAdminOfGroup($group_id))
            return redirect()->route('groups.show', ['group' => $group_id])->withErrors(['msg'=> 'home.forbidden.admin']); 
        return $next($request);
    }
}
