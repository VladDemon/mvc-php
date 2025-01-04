<?php

namespace App\Controller;

use App\Controller\Controller;
class LoginController extends Controller
{
    public function index() {
        return $this->view("/pages/signIn.html.twig", []);
    }
}
