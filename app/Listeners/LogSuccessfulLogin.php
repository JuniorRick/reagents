<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
      $log = new Logger('auth_logger');
      $path = storage_path('logs/auth.log');
      $log->pushHandler(new StreamHandler($path, Logger::INFO));

      $user = $event->user;
      $last_login_ip = request()->ip();

      $log->info("user " . $user->name . " was logged in from ip " . $last_login_ip );
    }
}
