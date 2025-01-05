<?php

namespace App\Controller;

use App\Controller\Controller;

class IndexController extends Controller
{
    public function index(): string {
        $query = 'SELECT id, name FROM test';
        $data = $this->loadAr($query);
        $logged_data = isset($_SESSION['user'])?$_SESSION['user']:null;
        return $this->view('/pages/index.html.twig', 
        ['title' => "HOME PAGE", 'data' => $data, "is_logged" => $logged_data]);
    }
}

