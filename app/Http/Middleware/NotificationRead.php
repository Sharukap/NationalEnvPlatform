<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NotificationRead
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
        $id=$request->route('nid');
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            dd($notification);
        }
        return $next($request);
    }
}
