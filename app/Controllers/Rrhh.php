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
            $mensaje = "Por favor ingrese usuario y contraseña!";
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
            $mensaje = "Por favor ingrese usuario y contraseña!";
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
            $mensaje = "Por favor ingrese usuario y contraseña!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

}





?>