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

    public function modificar_clave($param="")
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {   
            $id = $session->id;
            $personal = new Users_model();
            if($param == "modificar")
            {
                $clave_registrada = $this->session->userdata('clave');
                $clave_antigua = $this->input->post('clave');
                $clave_nueva = $this->input->post('nuevaClave');
                $clave_repetida = $this->input->post('claveRepetida');
                if ($clave_nueva <> $clave_repetida)
                {
                    echo ("<script>
                    alert('Las claves no coinciden!')</script>");
                    redirect('/rrhh/modificar_clave', 'refresh');
                }elseif ($clave_registrada == md5($clave_antigua))
                {
                    $clave = hash('sha256',$clave_nueva);
                    $this->Empleados_model->set_newPassword($id,$clave);
                    echo ("<script>
                    alert('Su clave fue modificada con éxito!')</script>");
                    redirect('/pages/index', 'refresh');

                }else{
                    echo ("<script>
                    alert('La clave actual no coincide!')</script>");
                    redirect('/rrhh/modificar_clave', 'refresh');
                }

            }else{
                $empleado = $personal->getUser($id);
                $data['empleados_item'] = $empleado->getUser($idPersonal);
                $data['title'] = 'Empleados archive';
                
                $empleado = $this->Empleados_model->get_empleado($id);
                $this->load->view('templates/head', $data);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/aside', $this->session->userdata());
                $this->load->view('secure/modificar_clave', $empleado);
                $this->load->view('templates/footer', $data);
            }
            
        }else
        {
             redirect('/secure/login', 'refresh');
        }


    }
   
}


?>