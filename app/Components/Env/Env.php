<?php

namespace App\Components\Env;

use App\Components\Interfaces\EnvInterface;
use Dotenv\Dotenv;

class Env implements EnvInterface
{

    public function __construct($path) { 
        $this->loadEnv($path);
    }
    public function loadEnv(string $path): void {
        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();
    }
}
