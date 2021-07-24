<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$type1,$type2)
    {
        $user = $request->user();
        if($user->type != $type1 && $user->type != $type2){

             abort(403,'you are not Admin');
        }

        return $next($request);
    }
}
