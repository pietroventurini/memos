<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;

class CheckIfCreatorOfPost
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
        $post_id = $request->route('post');
        $post = Post::find($post_id);
        if ($post == null)
            return redirect()->route('groups.show', ['group' => $group_id])->withErrors(['msg'=> __('home.post.not-found')], 404); 
        if($request->user()->id !== $post->user->id)
            return redirect()->route('groups.show', ['group' => $group_id])->withErrors(['msg'=> __('home.post.forbidden')], 403); 
        return $next($request);
    }
}
