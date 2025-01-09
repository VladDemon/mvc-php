<?php

namespace App\Controller\Profile;

use App\Controller\Controller;

class EditProfileController extends Controller
{
    public function pass_change ($data) 
    {
        
    }
    public function name_change ($data) 
    {
        
    }
    public function email_change ($data) 
    {

    }
    public function page() 
    {
        return $this->view('/pages/profile_edit.html.twig', []);
    }
}
