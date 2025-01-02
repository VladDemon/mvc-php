<?php

namespace App\Components\Interfaces;

interface EnvInterface
{
    public function loadEnv ( string $path ) : void;
}
