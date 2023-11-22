<?php

namespace App\Http\Middleware;

use App\Models\Place;
use Closure;
use Illuminate\Http\Request;

class CheckNamePlaseMiddleware
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
        if ($request->name_place && $request->type_id) {
            $check = Place::where('name_place', 'like', $request->name_place)->where('type_id', 'like', $request->type_id)->count();

            if ($check) {
                $err_place = true;
                return redirect(route('create_place', compact('err_place'))); // Редиректим не по ссылке а по названию пупи
            } else {
                return $next($request);
            }
        }else{
            return $next($request);
        }
    }
}
