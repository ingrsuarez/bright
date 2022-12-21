<?php

namespace App\Controllers;
use App\Models\Users_model;
use App\Models\Equipos_model;
use App\Models\Clientes_model;

class Equipos extends BaseController
{
    
    public function index()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subEquipos');
            echo view('templates/aside',$data);
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

// -----------------INVENTARIO---------------------------//

    public function nuevo()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subEquipos');
            echo view('templates/aside',$data);
            echo view('equipos/nuevo_equipo');
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
            $equipo = new Equipos_model();
            $nuevoEquipo = array('numero' => $this->request->getPost('numero') ,
                                'horas' => $this->request->getPost('horas'),
                                'capacidad' => $this->request->getPost('capacidad'),
                                'ubicacion' => $this->request->getPost('ubicacion'),
                                'marca' => $this->request->getPost('marca'),
                                'fecha_inicio' => $today,
                                'estado' => 'disponible'
                                );
            $equipo->setNewEquipment($nuevoEquipo);
            return redirect()->to('/equipos');

        }else{
        $mensaje = "Su sesion ha expirado!";
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
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function editar_equipo($id = NULL)
    {
        if ($id < 1)
        {
           return redirect()->to('/equipos/editar/1');

        }
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $next = $this->request->getPost('next'); 
            $data['nombre'] = ucfirst($session->usuario);
            $listado = new Equipos_model();
            $array['equipos'] = $listado->getEquipment($id);
            if ($array['equipos'] == NULL)
            {
                $lastId = $listado->getLastId();
                if ($id < $lastId->id)
                {   
                    if ($next == 'down')
                    {
                        $id -= 1;
                        return redirect()->to('/equipos/editar/'.$id);
                    }else
                    {
                        $id += 1;
                        return redirect()->to('/equipos/editar/'.$id);
                    }

                }else
                {
                   return redirect()->to('/equipos/editar/1'); 
                }
                
            }    
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subEquipos');
            echo view('templates/aside',$data);
            echo view('equipos/editar_equipo',$array);
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
            $equipo = new Equipos_model();
            $nuevoEquipo = array('id' => $id,
                                'numero' => $this->request->getPost('numero') ,
                                'serial' => $this->request->getPost('serial'),
                                'capacidad' => $this->request->getPost('capacidad'),
                                'ubicacion' => $this->request->getPost('ubicacion'),
                                'marca' => $this->request->getPost('marca'),
                                'estado' => 'activo'
                                );
            $equipo->update($id,$nuevoEquipo);
            return redirect()->to('/equipos/editar/'.$id);

        }else{
        $mensaje = "Su sesion ha expirado!";
        $session->setFlashdata('message',$mensaje);
        return redirect()->to('/login');
        }
    }



// -----------------ORDEN DE SERVICIO---------------------------//

    public function nuevaOrden()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['today'] = date("Y-m-d");
            $data['nombre'] = ucfirst($session->usuario);
            $listado = new Equipos_model();
            $data['equipos'] = $listado->getAvailableEquipments(); 
            $clientes = new Clientes_model();
            $data['clientes'] = $clientes->getClients();  
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subEquipos');
            echo view('templates/aside',$data);
            echo view('equipos/nueva_orden');
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }
        
    }

}





?>