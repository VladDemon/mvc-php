<?php
// App main abstract controller;

namespace App\Controller;

use App\Components\ViewRenderer\ViewRenderer;

use App\Components\Env\Env;
use App\Components\DataBase\Database;

abstract class Controller
{
    protected $viewRenderer;
    protected $db;

    public function __construct() {
        new Env(__DIR__ . "/../../");
        $this->db = new Database();

        $this->viewRenderer = new ViewRenderer();
    }
    public function loadAr($query, $attr) {
        return $this->db->get_assoc_data_by_query($query, $attr);
    }
    public function view ($file, $data = []) {
        return $this->viewRenderer->view($file, $data);
    }
}
