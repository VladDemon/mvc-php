<?php

namespace App\Controller\Profile;

use App\Controller\Controller;

class EditProfileController extends Controller
{
    public function pass_change ($data) 
    {
        session_start();
        $user_id = $_SESSION['user'];
        
        if (!isset($user_id)) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'User  not logged in']);
            exit;
        }
        
        $new_pass = $_POST['password'] ?? null;
        if ($new_pass) {
            $this->writeData('UPDATE users SET password = :password WHERE id = :id', ['password' => $new_pass, 'id' => $user_id['id']]);
        
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Password updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Password is required']);
        }
        exit;

    }
    public function name_change ($data) 
    {
        session_start();
        $user_id = $_SESSION['user'];
        
        if (!isset($user_id)) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'User  not logged in']);
            exit;
        }
        
        $new_name = $_POST['name'] ?? null;
        if ($new_name) {
            $this->writeData('UPDATE users SET name = :name WHERE id = :id', ['name' => $new_name, 'id' => $user_id['id']]);
            $_SESSION['user']['name'] = $new_name;
        
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Name updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Name is required']);
        }
        exit;
    }
    public function email_change ($data) 
    {
        session_start();
        $user_id = $_SESSION['user'];
        
        if (!isset($user_id)) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'User  not logged in']);
            exit;
        }
        
        $new_email = $_POST['email'] ?? null;
        if ($new_email) {
            $this->writeData('UPDATE users SET email = :email WHERE id = :id', ['email' => $new_email, 'id' => $user_id['id']]);
            $_SESSION['user']['email'] = $new_email;
        
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(['success' => true, 'message' => 'Email updated successfully']);
        } else {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Email is required']);
        }
        exit;
    }
    public function page() 
    {
        return $this->view('/pages/profile_edit.html.twig', []);
    }
}
