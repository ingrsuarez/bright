<?php

namespace App\Controllers;

use App\Models\Users_model;

class Rrhh extends BaseController
{
    
    public function index()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subRrhh');
            echo view('templates/aside',$data);
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function nuevo()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subRrhh');
            echo view('templates/aside',$data);
            echo view('rrhh/nuevo_personal');
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }
    public function ingresar()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $today = date("Y-m-d H:i:s");
            $usuario = new Users_model();
            $nuevoUsuario = array('nombre' => $this->request->getPost('nombre'),
                                'apellido' => $this->request->getPost('apellido'),
                                'mail' => $this->request->getPost('mail'),
                                'telefono' => $this->request->getPost('telefono'),
                                'fecha_ingreso' => $today,
                                'horas_semanales' => $this->request->getPost('horas'),
                                'fecha_nacimiento' => $this->request->getPost('fechaNacimiento'),
                                'cuil' => $this->request->getPost('cuil'),
                                'dni' => $this->request->getPost('dni'),
                                'domicilio' => $this->request->getPost('domicilio')
                                );
            $usuario->setNewUser($nuevoUsuario);
            return redirect()->to('/rrhh');
            
        }else{
        $mensaje = "Su sesión a expirado!";
        $session->setFlashdata('message',$mensaje);
        return redirect()->to('/login');
        }
    }

    public function listado()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            $nomina = new Users_model();
            $array['usuarios'] = $nomina->getUsers(); 
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subRrhh');
            echo view('templates/aside',$data);
            echo view('rrhh/listado_usuarios',$array);
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }


    public function editar_personal($id = NULL)
    {
        if ($id < 1)
        {
           return redirect()->to('/rrhh/editar/1');

        }
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['message'] = $session->getFlashdata('message');
            $data['nombre'] = ucfirst($session->usuario);
            $listado = new Users_model();
            $array['personal'] = $listado->getUser($id);
            if ($array['personal'] == NULL)
            {
                $lastId = $listado->getLastId();
                if ($id < $lastId->id)
                {
                    $id += 1;
                    return redirect()->to('/rrhh/editar/'.$id);
                }else
                {
                   return redirect()->to('/rrhh/editar/1'); 
                }
                
            }    
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subRrhh');
            echo view('templates/aside',$data);
            echo view('rrhh/editar_personal',$array);
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function modificar($id = NULL)
    {
        
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            
            $today = date("Y-m-d H:i:s");
            $usuario = new Users_model();
            $nuevoUsuario = array('nombre' => $this->request->getPost('nombre'),
                                'apellido' => $this->request->getPost('apellido'),
                                'mail' => $this->request->getPost('mail'),
                                'telefono' => $this->request->getPost('telefono'),
                                'fecha_ingreso' => $today,
                                'horas_semanales' => $this->request->getPost('horas'),
                                'fecha_nacimiento' => $this->request->getPost('fechaNacimiento'),
                                'cuil' => $this->request->getPost('cuil'),
                                'dni' => $this->request->getPost('dni'),
                                'domicilio' => $this->request->getPost('domicilio')
                                );
            $usuario->update($id,$nuevoUsuario);
            $mensaje = "El usuario se actualizó correctamente!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/rrhh/editar/'.$id);

        }else{
        $mensaje = "Su sesion ha expirado!";
        $session->setFlashdata('message',$mensaje);
        return redirect()->to('/login');
        }

    }

    public function altaPersonal($param='')
    {
       $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $personal = new Users_model();
            if (empty($param))
            {     
                $data['nombre'] = ucfirst($session->usuario);
                $data['personal'] = $personal->getUsersInactivos();
                $data['puestos'] = $personal->getPuestos();
                echo view('templates/head');
                echo view('templates/header');
                echo view('templates/header_subRrhh');
                echo view('templates/aside',$data);
                echo view('rrhh/alta_personal',$data);
                echo view('templates/footer');  
            }elseif($param == "consulta")
            {

                $idPersonal = $this->request->getPost('personal_id');  
    
                $array['personal'] = $personal->getUser($idPersonal);
                print_r(json_encode($array['personal']));
            }elseif($param == "send")
            {
                $emailTo = $this->request->getPost('mail');
                $puesto = $this->request->getPost('puesto');
                $idPersonal = $this->request->getPost('personal');
                $usuario = $personal->getUser($idPersonal);
                $horas = $this->request->getPost('horas');
                $nombreUsuario = substr(strtolower($usuario[0]->apellido), 0, 4).substr(strtolower($usuario[0]->nombre), 0, 4);
                $data = array(  'usuario' => $nombreUsuario,
                                'mail' => $emailTo,
                                'puesto' => $puesto,
                                'horas_semanales' => $horas,
                                'estado' => 'activo');
                $linkActivacion = hash('sha256',$usuario[0]->nombre.$emailTo);
                $personal->updateUser($idPersonal,$data);

                $email = \Config\Services::email();

                $email->setFrom('bright.soporte@admesys.com', 'Bright Sistemas');
                $email->setTo($emailTo);
                $email->setCC('');
                $email->setBCC('');

                $email->setSubject('Activacion');
                $email->setMessage('Por favor clicke el siguiente link para activar su cuenta: '.$linkActivacion);

                if($email->send())
                {   
                    echo ("<script>alert('La activación se realizó con éxito!')</script>");
                }else
                {
                    echo ("<script>alert('Hubo un problema con la activación!')</script>");
                }
            }    
            

        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }
    }

    public function email1()
    {

        $email = \Config\Services::email();

        $email->setFrom('bright.soporte@admesys.com', 'Rodrigo');
        $email->setTo($emailTo);
        $email->setCC('');
        $email->setBCC('');

        $email->setSubject('Email Test');
        $email->setMessage('Testing the email class. 2.0');

        if($email->send())
        {   
            echo ("<script>
                alert('La activación se realizó con éxito!')</script>");
        }else
        {
            echo ("<script>
                alert('Hubo un problema con la activación!')</script>");
        }
                
    }








}





?>