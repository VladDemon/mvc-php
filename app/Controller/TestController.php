<?php
namespace App\Controller;

use App\Controller\Controller;

class TestController extends Controller{

    public function index() {
        return $this->view('/pages/test.html.twig',[
            'title' => "test PAGE",
        ]);
    }
}