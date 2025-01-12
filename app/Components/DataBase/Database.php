<?php

namespace App\Components\DataBase;
use App\Components\Interfaces\DatabaseInterface;
use PDO;
use PDOException;
class Database implements DatabaseInterface
{
    private $db;

    public function __construct() {
        $this->initDbConnection();
    }
    private function initDbConnection(): void {
        $host = $_ENV["DB_HOST"];
        $dbname = $_ENV["DB_NAME"]; 
        $username = $_ENV["DB_USER"];
        $password = $_ENV["DB_PASSWORD"];
        $port = $_ENV['DB_PORT'];
        try {
            $this->db = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }
    public function getDb(): PDO {
        return $this->db;
    }
    public function get_assoc_data_by_query ($query, array $attr) : array {
        $db = $this->getDb();
        $query = $db->prepare($query);
        $query->execute($attr);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function writeData(string $query, array $attr) : bool {
        $db = $this->getDb();
        $query = $db->prepare($query);
        $result = $query->execute($attr);

        if(!$result) {
            return false;
        }
        return true;
    }
}
