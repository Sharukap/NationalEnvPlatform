<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Env;
use App\Models\Species;
use Illuminate\Support\Facades\Auth;

class RestrictSystemData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next , $type)
    {
        $id=$request->route('id');
        if($type==1){
            $record=Env::find($id);
        }
        else{
            $record=Species::find($id);
        }
        $user = Auth::user()->id;
        if($user == $record->created_by_user_id){    
            return back()->with('warning', 'You cannot approve your own records '); 
        }
        return $next($request);
    }
}
