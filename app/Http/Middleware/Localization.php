<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
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
        if (\Session::has('locale')) {
            \App::setlocale(\Session::get('locale'));
            $langList = config('constants.lang');
            $lang = array_key_exists(app()->getLocale(), $langList) ? $langList[app()->getLocale()] : app()->getLocale();

            session(['lang' => $lang]);
       }

       return $next($request);
    }

}
