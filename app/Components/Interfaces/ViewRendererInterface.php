<?php

namespace App\Components\Interfaces;



interface ViewRendererInterface
{
    public function view (string $file, array $data = []) : string;
}
