<?php

namespace App\Controller;

use App\Controller\Controller;



class Controller404 extends Controller
{
    public function index() {
        return $this->view("/error/404.html.twig");
    }
}
