<?php

namespace App\Controller;

use App\Controller\Controller;

class RegisterController extends Controller
{
    public function index () {
        return $this->view('/pages/register.html.twig', []);
    }
}
