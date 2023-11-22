<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddHashMiddleware
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
//        dump($next);
        $response = $next($request);
        $hash = md5($response);
//        dd(get_class_methods($response)); // Получить методы класса
//        dd($response->getContent());
        $response->setContent($response->getContent() . $hash);
//        dd($response->getContent());
        return $response;
    }
}
