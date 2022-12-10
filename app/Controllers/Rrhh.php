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










}





?>