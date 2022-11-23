<?php

namespace App\Controllers;

class Secure extends BaseController
{

    public function login()
    {
        $session = \Config\Services::session(); 
        $data['message'] = $session->getFlashdata('message');
        echo view('templates/head');    
        echo view('secure/login',$data);
    }

    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to('/login');
    }
   
}


?>