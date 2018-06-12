<?php

namespace App\Http\Middleware;

use Closure;

class SessionHandler
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

      $response = $next($request);
      if ( $request->session()->has('flag')) {
          $request->session()->forget('bulk_success');
      }

        return $response;
    }
}
