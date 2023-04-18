<?php

namespace App\Controllers;
use App\Models\Users_model;
use App\Models\Equipos_model;
use App\Models\Clientes_model;
use App\Models\Ordenes_model;
use App\Models\Remitos_model;

class Equipos extends BaseController
{
    private $activeMenu = array('','dropdown__item--active','','');
    public function index()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['active'] = $this->activeMenu;
            $data['nombre'] = ucfirst($session->nombre);
            $equipos = new Equipos_model();
            $disponible = $equipos->getAvailablePercentage('disponible');
            $servicio = $equipos->getAvailablePercentage('servicio');
            $revision = $equipos->getAvailablePercentage('inspeccionar');
            $graph['equipos'] = array($disponible,$servicio,$revision);
            echo view('templates/head');
            echo view('templates/headerImage',$data);
            echo view('templates/aside',$data);
            echo view('templates/header_subEquipos');
            echo view('templates/bar_graph',$graph);
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
            $data['active'] = $this->activeMenu;
            $data['nombre'] = ucfirst($session->nombre);
            echo view('templates/head');
            echo view('templates/header',$data);
            echo view('templates/aside',$data);
            echo view('templates/header_subEquipos');
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
            unset($_POST);
            return redirect()->to('/equipo/nuevo');

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
            $data['active'] = $this->activeMenu;
            $data['nombre'] = ucfirst($session->nombre);
            $listado = new Equipos_model();
            $array['equipos'] = $listado->getEquipments(); 
            echo view('templates/head');
            echo view('templates/header',$data);
            echo view('templates/aside',$data);            
            echo view('templates/header_subEquipos');
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
            $data['active'] = $this->activeMenu;
            $next = $this->request->getPost('next'); 
            $data['nombre'] = ucfirst($session->nombre);
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
            echo view('templates/header',$data);
            echo view('templates/aside',$data);            
            echo view('templates/header_subEquipos');
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
                                'estado' => $this->request->getPost('estado'),
                                'marca' => $this->request->getPost('marca')
                                );
            $equipo->update($id,$nuevoEquipo);
            return redirect()->to('/equipos/editar/'.$id);

        }else{
        $mensaje = "Su sesion ha expirado!";
        $session->setFlashdata('message',$mensaje);
        return redirect()->to('/login');
        }
    }



// -----------------ORDEN DE MANTENIMIENTO---------------------------//

    public function nuevaOrden($param = NULL)
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        { 
            $data['active'] = $this->activeMenu;
            if ($param == NULL)
            { 
                $data['message'] = $session->getFlashdata('message');
                $data['today'] = date("Y-m-d");
                $data['nombre'] = ucfirst($session->nombre);
                $listado = new Equipos_model();
                $data['equipos'] = $listado->getEquipments();
                echo view('templates/head');
                echo view('templates/header',$data);
                echo view('templates/aside',$data);                
                echo view('templates/header_subEquipos');
                echo view('equipos/nueva_orden',$data);
                echo view('templates/footer');
            }elseif($param == "equipo")
            {
                $numero_equipo = $this->request->getPost('idEquipo'); 
                $data['remitos_url'] = site_url("/ventas/pdfRemito/");
                $equipo = new Equipos_model();
                $data['equipo'] = $equipo->getEquipmentMovements($numero_equipo);
                $data['remitos'] = $equipo->getLastRemitos($numero_equipo);
                
                
                print_r(json_encode($data));
            }elseif($param == "guardar")
            {
                $button = $this->request->getPost('button');
                $numeroRemito = $this->request->getPost('remitos');
                $idEquipo = $this->request->getPost('equipo');
                $equipo = new Equipos_model();
                //----------Service done to an Available equipment----------------------- 
                if(empty($numeroRemito))
                {
                    if ($button == 'Guardar'){
                        $estado = 'abierta';
                        $equipo->setEstadoOnly($idEquipo,'mantenimiento');
                    }else
                    {
                        $estado = 'cerrada';
                        $equipo->setEstadoOnly($idEquipo,'disponible');
                    }
                    $nuevaOrden = array(
                                    'fecha' => $this->request->getPost('fecha') ,
                                    'equipo' => $this->request->getPost('equipo'),
                                    'descripcion' => $this->request->getPost('descripcion'),
                                    'repuestos' => $this->request->getPost('repuestos'),
                                    'cargos_cliente' => '',
                                    'usuario' => $session->id,                            
                                    'horas' => $this->request->getPost('horas'),
                                    'remito' => '',
                                    'estado' => $estado
                                    );
                    $orden = new Ordenes_model();
                    $orden->setNewOrder($nuevaOrden);
                    $mensaje = "La orden fue guardada correctamente!";
                    $session->setFlashdata('message',$mensaje);
                    return redirect()->to('/equipo/nueva_orden/');
                }else
                //----------Service done to a returned equipment-----------------------
                {
                    $remito = new Remitos_model();
                    if ($button == 'Guardar'){
                        $estado = 'abierta';
                    }else
                    {
                        $estado = 'cerrada';
                        $remito->setEstadoRemito($numeroRemito,'facturar');
                        $equipo->setEstadoOnly($idEquipo,'disponible');
                    }
                    $remito = new Remitos_model();
                    $cargos = " ".$this->request->getPost('cargos');
                    $remito->setCargosRemito($numeroRemito,$cargos);

                    $nuevaOrden = array(
                                    'fecha' => $this->request->getPost('fecha') ,
                                    'equipo' => $this->request->getPost('equipo'),
                                    'descripcion' => $this->request->getPost('descripcion'),
                                    'repuestos' => $this->request->getPost('repuestos'),
                                    'cargos_cliente' => $this->request->getPost('cargos'),
                                    'usuario' => $session->id,                            
                                    'horas' => $this->request->getPost('horas'),
                                    'remito' => $numeroRemito,
                                    'estado' => $estado
                                    );
                    $orden = new Ordenes_model();
                    $orden->setNewOrder($nuevaOrden);
                    $mensaje = "La orden fue guardada correctamente!";
                    $session->setFlashdata('message',$mensaje);
                    return redirect()->to('/equipo/nueva_orden/');
                }
            }
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }
        
    }

    public function ordenesAbiertas($param = NULL)
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        { 
            if ($param == NULL)
            { 
                $data['active'] = $this->activeMenu;
                $data['message'] = $session->getFlashdata('message');
                $data['today'] = date("Y-m-d");
                $data['nombre'] = ucfirst($session->nombre);
                $listado = new Ordenes_model();
                $data['ordenes'] = $listado->getOpenOrders();
                echo view('templates/head');
                echo view('templates/header',$data);
                echo view('templates/aside',$data);                
                echo view('templates/header_subEquipos');
                echo view('equipos/ordenes_abiertas',$data);
                echo view('templates/footer');
            }elseif($param == "equipo")
            {
                $numero_orden = $this->request->getPost('idOrden'); 
                $data['remitos_url'] = site_url("/ventas/pdfRemito/");
                $orden = new Ordenes_model();
                $data['orden'] = $orden->getOrder($numero_orden);
                $numero_equipo = $data['orden'][0]->id_equipo; 
                $equipo = new Equipos_model();
                $data['equipo'] = $equipo->getEquipmentMovements($numero_equipo);
                $data['remitos'] = $equipo->getLastRemitos($numero_equipo);
                
                print_r(json_encode($data));
            }elseif($param == "q")
            {
                $numero_orden = 4;//$this->request->getPost('id_orden'); 
                $data['remitos_url'] = site_url("/ventas/pdfRemito/");
                $orden = new Ordenes_model();
                $data['orden'] = $orden->getOrder($numero_orden);
                $numero_equipo = $data['orden'][0]->id_equipo; 
                $equipo = new Equipos_model();
                $data['equipo'] = $equipo->getEquipmentMovements($numero_equipo);
                $data['remitos'] = $equipo->getLastRemitos($numero_equipo);
                
                var_dump($data);
            }elseif($param == "guardar")
            {
                $button = $this->request->getPost('button');
                $idOrden = $this->request->getPost('numero_orden');
                $numeroRemito = $this->request->getPost('remitos');
                $idEquipo = $this->request->getPost('equipo');
                $equipo = new Equipos_model();
                //----------Service done to an Available equipment----------------------- 
                if(empty($numeroRemito))
                {
                    if ($button == 'Guardar'){
                        $estado = 'abierta';
                    }else
                    {
                        $estado = 'cerrada';
                        $equipo->setEstadoOnly($idEquipo,'disponible');
                    }
                    $nuevaOrden = array(
                                    'fecha' => $this->request->getPost('fecha') ,
                                    'equipo' => $this->request->getPost('equipo'),
                                    'descripcion' => $this->request->getPost('descripcion'),
                                    'repuestos' => $this->request->getPost('repuestos'),
                                    'cargos_cliente' => '',
                                    'usuario' => $session->id,                            
                                    'horas' => $this->request->getPost('horas'),
                                    'remito' => '',
                                    'estado' => $estado
                                    );
                    $orden = new Ordenes_model();
                    $orden->updateOrder($idOrden,$nuevaOrden);
                    $mensaje = "La orden fue guardada correctamente!";
                    $session->setFlashdata('message',$mensaje);
                    return redirect()->to('/equipo/ordenes_abiertas/');
                    

                }else
                //----------Service done to a returned equipment-----------------------
                {
                    $remito = new Remitos_model();
                    if ($button == 'Guardar'){
                        $estado = 'abierta';
                    }else
                    {
                        $estado = 'cerrada';
                        $remito->setEstadoRemito($numeroRemito,'facturar');
                        $equipo->setEstadoOnly($idEquipo,'disponible');
                    }
                    $remito = new Remitos_model();
                    $cargos = " ".$this->request->getPost('cargos');
                    $remito->setCargosRemito($numeroRemito,$cargos);

                    $nuevaOrden = array(
                                    'fecha' => $this->request->getPost('fecha') ,
                                    'equipo' => $this->request->getPost('equipo'),
                                    'descripcion' => $this->request->getPost('descripcion'),
                                    'repuestos' => $this->request->getPost('repuestos'),
                                    'cargos_cliente' => $this->request->getPost('cargos'),
                                    'usuario' => $session->id,                            
                                    'horas' => $this->request->getPost('horas'),
                                    'remito' => $numeroRemito,
                                    'estado' => $estado
                                    );
                    
                    $orden = new Ordenes_model();
                    $orden->updateOrder($idOrden,$nuevaOrden);
                    $mensaje = "La orden fue guardada correctamente!";
                    $session->setFlashdata('message',$mensaje);
                    return redirect()->to('/equipo/nueva_orden/');
                }
            }
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }
        
    }

    public function listadoOrdenes()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['active'] = $this->activeMenu;
            $data['nombre'] = ucfirst($session->nombre);
            $listado = new Ordenes_model();
            $array['ordenes'] = $listado->getOrdersView(); 
            echo view('templates/head');
            echo view('templates/header',$data);
            echo view('templates/aside',$data);            
            echo view('templates/header_subEquipos');
            echo view('equipos/listado_ordenes',$array);
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }












}





?>