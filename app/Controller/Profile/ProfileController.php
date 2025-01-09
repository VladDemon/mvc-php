<?php

namespace App\Controller\Profile;

use App\Controller\Controller;

class ProfileController extends Controller
{
    public function index () 
    {
        $id =  $_SESSION['user']['id'];
        $data = $this->loadAr("SELECT id, name, email, created_at FROM users WHERE id = ?", [$id]);
        return $this->view('pages/profile.html.twig', ['user' => $data[0]]);
    }
    
}
