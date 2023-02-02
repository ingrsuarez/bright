<?php

namespace App\Controllers;
use App\Models\Users_model;

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

    public function activate($id=false,$link=false)
    {
        $personal = new Users_model();
        $usuario = $personal->getUser($id);
        // var_dump($usuario);
        $hash = hash('sha256',$usuario[0]->nombre.$usuario[0]->mail);
        if ($hash == $link)
        {
            echo ("Las claves coinciden  ");
            echo ("link: ".$link);
            echo("hash: ".$hash);
        }else
        {
            echo ("Las claves NO coinciden  ");
            echo ("link: ".$link);
            echo("hash: ".$hash); 
        }

        // if ($link ==)
    }
   
}


?>