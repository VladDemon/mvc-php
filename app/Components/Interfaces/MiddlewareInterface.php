<?php

namespace App\Components\Interfaces;

interface MiddlewareInterface
{
    public function handle ($request, $next);
}
