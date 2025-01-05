<?php

namespace App\Components\Middleware;

use App\Components\Interfaces\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle($request, $next)  {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /signIn");
            exit;
        }
        return $next($request);
    }
}
