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
            $equipo = new Equipos_model();
            $nuevoEquipo = array('numero' => $this->request->getPost('numero') ,
                                'serial' => $this->request->getPost('serial'),
                                'capacidad' => $this->request->getPost('capacidad'),
                                'ubicacion' => $this->request->getPost('ubicacion'),
                                'fecha_inicio' => $today,
                                'estado' => 'activo'
                                );
            $equipo->setNewEquipment($nuevoEquipo);
            return redirect()->to('/equipos');

        }else{
        $mensaje = "Por favor ingrese usuario y contraseña!";
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
            $listado = new Equipos_model();
            $array['equipos'] = $listado->getEquipments(); 
            echo view('templates/head');
            echo view('templates/header_sub');
            echo view('templates/aside',$data);
            echo view('equipos/listado_equipos',$array);
            echo view('templates/footer');
        }else{
            $mensaje = "Por favor ingrese usuario y contraseña!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

}





?>