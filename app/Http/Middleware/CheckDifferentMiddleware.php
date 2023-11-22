<?php

namespace App\Http\Middleware;

use App\Models\Name;
use Closure;
use Illuminate\Http\Request;

class CheckDifferentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->fist_name && $request->second_name) {
            $check = Name::where('fist_name', 'like', $request->fist_name)->where('second_name', 'like', $request->second_name)->count();

            if ($check) {
                return redirect(route('forms')); // Редиректим не по ссылке а по названию пупи
            } else {
                return $next($request);
            }
        }else{
            return $next($request);
        }
    }
}
