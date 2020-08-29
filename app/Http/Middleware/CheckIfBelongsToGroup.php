<?php

namespace App\Http\Middleware;

use Closure;
use App\Group;

class CheckIfBelongsToGroup
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
        //route('param_name_defined_in_route') retrieves the group id
        $group_id = $request->route('group');

        // check if group exists
        if (!(Group::where('id', '=', $group_id)->exists()))
            return redirect()->route('home')->withErrors(['msg'=> __('home.error.group')]);
            
        // check if user belongs to group
        if (!$request->user()->belongsToGroup($group_id))
            return redirect()->route('home')->withErrors(['msg'=> __('home.forbidden.group')]);        

        return $next($request);
    }
}
