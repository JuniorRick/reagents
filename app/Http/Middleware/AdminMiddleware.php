<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
      if ($request->user()) {

        $role_admin = \Spatie\Permission\Models\Role::where('name', 'admin');

          if($request->user()->getRoleNames()[0] != 'admin') {
            return response(view('home'));
          }

      }

      return $next($request);
    }
}
