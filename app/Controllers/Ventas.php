<?php

namespace App\Controllers;
use App\Models\Users_model;
use App\Models\Equipos_model;
use App\Models\Clientes_model;

class Ventas extends BaseController
{
    
    public function index()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subVentas');
            echo view('templates/aside',$data);
            echo view('templates/footer');
        }else{
            $mensaje = "Por favor ingrese usuario y contraseña!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function nuevo_remito()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subVentas');
            echo view('templates/aside',$data);
            echo view('ventas/nuevo_remito');
            echo view('templates/footer');
        }else{
            $mensaje = "Por favor ingrese usuario y contraseña!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function ingresar_remito()
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
            echo view('templates/header');
            echo view('templates/header_subEquipos');
            echo view('templates/aside',$data);
            echo view('equipos/listado_equipos',$array);
            echo view('templates/footer');
        }else{
            $mensaje = "Por favor ingrese usuario y contraseña!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function nuevo_cliente()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subVentas');
            echo view('templates/aside',$data);
            echo view('ventas/nuevo_cliente');
            echo view('templates/footer');
        }else{
            $mensaje = "Por favor ingrese usuario y contraseña!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function ingresar_cliente()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $today = date("Y-m-d H:i:s");
            $cliente = new Clientes_model();
            $nuevoCliente = array('fecha' => $today,
                                'nombre' => $this->request->getPost('nombre'),
                                'cuit' => $this->request->getPost('cuit'),
                                'iva' => $this->request->getPost('iva'),
                                'telefono' => $this->request->getPost('telefono'),
                                'domicilio' => $this->request->getPost('domicilio'),
                                'email' => $this->request->getPost('email'),
                                'codigo_postal' => $this->request->getPost('postal'),
                                'estado' => 'activo'
                                );
            $cliente->setNewClient($nuevoCliente);
            return redirect()->to('/ventas/nuevo_cliente');

        }else{
        $mensaje = "Por favor ingrese usuario y contraseña!";
        $session->setFlashdata('message',$mensaje);
        return redirect()->to('/login');
        }
    }

}





?>