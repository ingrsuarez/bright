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
        $data['nombre'] = $usuario[0]->usuario;
        $data['id_usuario'] = $id;
        $data['link'] = $link;
        if($usuario[0]->estado == 'activar')
        {
            if ($hash == $link)
            {
                if(empty($_POST))
                {
                    $data['message'] = 'Porfavor complete sus datos!';
                    echo view('templates/head');
                    echo view('secure/activate',$data);
                }else{
                    $password = $this->request->getPost('password');
                    $repeat_password = $this->request->getPost('repeat_password');
                    if($password == $repeat_password)
                    {
                       
                        $data = array(  'clave' => hash('sha256',$password),
                                'estado' => 'activo');
                        $personal->updateUser($id,$data);
                        $session = \Config\Services::session();
                        $mensaje = "Su contraseña fue ingresada con éxito!";
                        $session->setFlashdata('message',$mensaje);
                        return redirect()->to('/login');
                    }else
                    {
                        $data['message'] = 'Las contraseñas no coinciden!';
                        echo view('templates/head');
                        echo view('secure/activate',$data);
                    }
                    
                }
               

            }else
            {
                echo ("Las claves NO coinciden  ");
                echo ("link: ".$link);
                echo("hash: ".$hash); 
            }
        }else
        {
            $session = \Config\Services::session();
            $mensaje = "Este usuario ya fue activado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }
        
    }
   
}


?>