<?php

namespace App\Components\DataBase;

use App\Components\DataBase\Database;

class DataBaseTables
{
    protected $db;

    public function __construct() 
    {
        $this->db = new Database();

        $this->ensureUsersTableExists();
        $this->ensureAuthorsTableExists();

        $this->ensureBooksTableExists();
        $this->ensureChaptersTableExists();
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
    
    private function ensureAuthorsTableExists()
    {
        $this->db->getDb()->exec("CREATE TABLE IF NOT EXISTS authors (
            author_id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            bio TEXT
        )");
    }
    
    private function ensureBooksTableExists()
    {
        $this->db->getDb()->exec("CREATE TABLE IF NOT EXISTS books (
            book_id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            author_id INT,
            user_id INT,
            views INT DEFAULT 0,
            likes INT DEFAULT 0,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (author_id) REFERENCES authors(author_id),
            FOREIGN KEY (user_id) REFERENCES users(id) 
        )");
    }
    
    private function ensureChaptersTableExists()
    {
        $this->db->getDb()->exec("CREATE TABLE IF NOT EXISTS chapters (
            chapter_id INT PRIMARY KEY AUTO_INCREMENT,
            book_id INT,
            title VARCHAR(255) NOT NULL,
            content TEXT,
            chapter_number INT NOT NULL,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (book_id) REFERENCES books(book_id)
        )");
    }
}
