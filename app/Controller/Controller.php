<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use PDO;
use PDOException;
use Dotenv\Dotenv;

abstract class Controller
{
    protected $twig;
    private $db;

    public function __construct() {
        $loader = new FilesystemLoader(__DIR__ . '/../View/');
        $this->twig = new Environment($loader);
        $this->loadEnv();
        $this->initDbConnection();
    }

    private function loadEnv () {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->load();
    }
    private function initDbConnection(): void {
        $host = $_ENV["DB_HOST"];
        $dbname = $_ENV["DB_NAME"]; 
        $username = $_ENV["DB_USER"];
        $password = $_ENV["DB_PASSWORD"];
        $port = $_ENV['DB_PORT'];
        try {
            $this->db = new PDO("mysql:host=$host:$port;dbname=$dbname;charset=utf8", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
    protected function getDb(): PDO {
        return $this->db;
    }

    public function get_assoc_data_by_query ($query) {
        $db = $this->getDb();
        $query = $db->prepare($query);
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function view ($file, $data = []) : string {
        return $this->twig->render($file, $data);
    }
}
