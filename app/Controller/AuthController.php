<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Services\Router;
use Exception;

class AuthController extends Controller
{
    public function register($data)
    {
        $name = $data["name"];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        try {
            $this->ensureUsersTableExists();

            $stmt = $this->db->getDb()->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetchColumn() > 0) {
                throw new Exception("Email уже зарегистрирован.");
            }

            $stmt = $this->db->getDb()->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);

            session_start();
            // $_SESSION['user'] = [
            //     'id' => $this->db->getDb()->lastInsertId(),
            //     'name' => $name,
            //     'email' => $email
            // ];

            Router::redirect("/signIn");
        } catch (Exception $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public function login($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        try {
            $stmt = $this->db->getDb()->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if (!$user || !password_verify($password, $user['password'])) {
                throw new Exception("Неверный email или пароль.");
            }

            session_start();
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            header("Location: /");
        } catch (Exception $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public function logout()
    {
        session_start();
        $sesFile = session_save_path() . '/sess' . session_id();
        session_unset();
        session_destroy();
        if (file_exists($sesFile)) {
            unlink($sesFile);
        }
        Router::redirect("/signIn");
    }

    private function ensureUsersTableExists()
    {
        $this->db->getDb()->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    }
}
