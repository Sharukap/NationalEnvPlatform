<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Process_item;

class RestrictOwnRequests
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
        $id=$request->route('id');
        $process=Process_item::find($id);
        $user = Auth::user()->id;
        if($user == $process->created_by_user_id){    
            return back()->with('message', 'You cannot handle the approval process of your own applications '); 
        }
        return $next($request);
    }
}
