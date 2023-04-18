<?php

namespace App\Controllers;
use App\Models\Users_model;
use App\Models\Equipos_model;
use App\Models\Clientes_model;
use App\Models\Remitos_model;
use App\Models\Movimientos_model;


class Ventas extends BaseController
{
    private $activeMenu = array('','','dropdown__item--active','');
    public function index()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['active'] = $this->activeMenu;
            $remitos = new Remitos_model();
            $inspeccion = $remitos->getRemitosPercentage('retorno');
            $facturar = $remitos->getRemitosPercentage('facturar');
            $facturado = $remitos->getRemitosPercentage('facturado');
            $graph['remitos'] = array($inspeccion,$facturar,$facturado);
            $data['nombre'] = ucfirst($session->nombre);
            
            echo view('templates/head');
            echo view('templates/headerImage',$data);
            echo view('templates/aside',$data);
            echo view('templates/header_subVentas');
            echo view('templates/remitos_graph.php',$graph);
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function nuevo_remito($param = NULL)
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $listado = new Equipos_model();
            if ($param == NULL)
            {
                $remito = new Remitos_model();
                $data['active'] = $this->activeMenu;
                $data['today'] = date("Y-m-d");
                $data['nombre'] = ucfirst($session->nombre);
                $data['ultimoRemito'] = $remito->getLastRemito();
                $data['equipos'] = $listado->getAvailableEquipments(); 
                $clientes = new Clientes_model();
                $data['clientes'] = $clientes->getClients();  
                $data['hora'] = date('H:i');
                echo view('templates/head');
                echo view('templates/header',$data);
                echo view('templates/aside',$data);
                echo view('templates/header_subVentas');
                echo view('ventas/nuevo_remito');
                echo view('templates/footer');
            }elseif ($param == "salida")
                {
                    $tipoRemito = $this->request->getPost('tipoRemito');  
                    if ($tipoRemito == 'salida'){
                        $array['equipos'] = $listado->getAvailableEquipments();
                    }elseif ($tipoRemito == 'retorno')
                    {
                        $array['equipos'] = $listado->getWorkingEquipments();
                    }

                    print_r(json_encode($array['equipos']));


                }
            
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }
    }

    public function ingresar_remito()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            
            $data['equipos_seleccionados'] = $this->request->getPost('equipos_seleccionados');
            $data['equipos'] = $this->request->getPost('equipos');
            $data['horas'] = $this->request->getPost('horas');
            $data['capacidad'] = $this->request->getPost('capacidad');

            if (!empty($data['equipos_seleccionados'])) 
            {
                $equipos_seleccionados = array_intersect($data['equipos'],$data['equipos_seleccionados']);
                $horas = array_intersect_key($data['horas'],$equipos_seleccionados);
                $capacidad = array_intersect_key($data['capacidad'],$equipos_seleccionados);
                $remito = new Remitos_model();
                $movimiento = new Movimientos_model();
                $equipo = new Equipos_model();
                $nuevoRemito = array('fecha' => $this->request->getPost('fecha'),
                                    'numero' => $this->request->getPost('numero'),
                                    'punto_venta' => '01',
                                    'usuario' => $session->id,
                                    'cliente' => $this->request->getPost('cliente'),
                                    'leyenda' => $this->request->getPost('leyenda'),
                                    'domicilio' => $this->request->getPost('domicilio'),
                                    'hora' => $this->request->getPost('hora'),
                                    'kilometros' => $this->request->getPost('kilometros'),
                                    'estado' => $this->request->getPost('tipo')
                                    );
                
                $remito_id = $remito->setNewRemito($nuevoRemito);
                foreach ($equipos_seleccionados as $key => $id)
                    {
                        $cliente = $remito->getClient($remito_id);
                        $ubicacion = $cliente->nombre;
                        $numero_equipo = $equipo->getEquipmentNumber($id);
                        if($this->request->getPost('tipo') == 'salida'){
                            $estado = 'servicio';
                        }else{
                            $estado = 'inspeccionar';
                            $ubicacion = 'base';
                        }
                        $nuevoMovimiento = array('fecha' => $this->request->getPost('fecha') ,
                                    'usuario' => $session->id,
                                    'equipo' => $id,
                                    'numero_equipo' => $numero_equipo,
                                    'horas' => $horas[$key],
                                    'capacidad' => $capacidad[$key],
                                    'ubicacion' => strtoupper($ubicacion),
                                    'cliente' => strtoupper($this->request->getPost('cliente')),
                                    'remito' => $remito_id,
                                    'transporte' => $this->request->getPost('transporte'),
                                    'tipo' => $this->request->getPost('tipo'),
                                    'estado' => $this->request->getPost('tipo')
                                    );
                        $movimiento->setNewMovimiento($nuevoMovimiento);
                        
                        $peso = $equipo->updatePeso($id);
                        $equipo->setEstado($id,$estado,$horas[$key],$ubicacion);                    
                    } 
                    $data['remito_id'] = $remito_id;
                    echo view('ventas/generar_remito',$data);
                
                }else
                {
                    
                    echo "<script> alert('Debe seleccionar un equipo');</script>";
                    echo "<script> window.open('https://bright.admesys.com/ventas/nuevo_remito/','_self');
                    </script>";
                }
                

                
        }else{
        $mensaje = "Su sesion ha expirado!";
        $session->setFlashdata('message',$mensaje);
        return redirect()->to('/login');
        }
    }


    public function listadoRemitos()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['active'] = $this->activeMenu;
            $data['nombre'] = ucfirst($session->nombre);
            $listadoRemitos = new Remitos_model();
            $array['remitos'] = $listadoRemitos->getRemitosView(); 
            echo view('templates/head');
            echo view('templates/header',$data);
            echo view('templates/aside',$data);            
            echo view('templates/header_subVentas');
            echo view('ventas/listado_remitos',$array);
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    

    public function pdf_remito($numeroRemito)
    {
        $remito = new Remitos_model();
        $data['cliente'] = $remito->getClient($numeroRemito);
        $data['remito'] = $remito->getRemito($numeroRemito);
        $data['movimientos'] = $remito->getMovimientos($numeroRemito);
        echo view('ventas/pdf_remito',$data);
    }


    public function nuevo_cambio($param = NULL) //CAMBIO DE EQUIPO
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $listado = new Equipos_model();
            if ($param == NULL)
            {
                $remito = new Remitos_model();
                $data['active'] = $this->activeMenu;
                $data['today'] = date("Y-m-d");
                $data['nombre'] = ucfirst($session->nombre);
                $data['ultimoRemito'] = $remito->getLastRemito();
                $data['equipos'] = $listado->getAvailableEquipments(); 
                $clientes = new Clientes_model();
                $data['clientes'] = $clientes->getClients();  
                $data['hora'] = date('H:i');
                echo view('templates/head');
                echo view('templates/header',$data);
                echo view('templates/aside',$data);
                echo view('templates/header_subVentas');
                // echo view('ventas/nuevo_cambio');
                echo view('templates/footer');
            }elseif ($param == "salida")
                {
                    $tipoRemito = $this->request->getPost('tipoRemito');  
                    if ($tipoRemito == 'salida'){
                        $array['equipos'] = $listado->getAvailableEquipments();
                    }elseif ($tipoRemito == 'retorno')
                    {
                        $array['equipos'] = $listado->getWorkingEquipments();
                    }

                    print_r(json_encode($array['equipos']));


                }
            
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

    public function listadoEditarRemitos($numero = NULL)
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            if(empty($numero))
            {
                $data['active'] = $this->activeMenu;
                $data['nombre'] = ucfirst($session->nombre);
                $listadoRemitos = new Remitos_model();
                $array['remitos'] = $listadoRemitos->getRemitosView(); 
                echo view('templates/head');
                echo view('templates/header',$data);
                echo view('templates/aside',$data);
                echo view('templates/header_subVentas');
                echo view('ventas/listado_editarRemitos',$array);
                echo view('templates/footer');
            }else{
                $data['active'] = $this->activeMenu;
                $listadoClientes = new Clientes_model();
                $data['clientes'] = $listadoClientes->getClients();
                $data['nombre'] = ucfirst($session->nombre);
                $remito = new Remitos_model();
                $data['remito'] = $remito->getRemito($numero); 
                echo view('templates/head');
                echo view('templates/header',$data);
                echo view('templates/aside',$data);
                echo view('templates/header_subVentas');
                echo view('ventas/editar_remito',$data);
                echo view('templates/footer');    
            }
                
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }

    public function editarRemito($numero)
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            if (!empty($_POST))
            {
                $remito = new Remitos_model();
                $nuevoRemito = array('fecha' => $this->request->getPost('fecha'),
                                        'punto_venta' => '01',
                                        'usuario' => $session->id,
                                        'cliente' => $this->request->getPost('cliente'),
                                        'leyenda' => $this->request->getPost('leyenda'),
                                        'domicilio' => $this->request->getPost('domicilio'),
                                        'hora' => $this->request->getPost('hora'),
                                        'kilometros' => $this->request->getPost('kilometros'),
                                        'cargos' => $this->request->getPost('cargos'),
                                        'estado' => $this->request->getPost('tipo')
                                        );
                $remito->updateRemito($numero,$nuevoRemito);
            }

            return redirect()->to('/ventas');

        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }

    }

    //-------------------------------------CLIENTES------------------------------------------//
    public function saldosClientes($param="")
    {
         $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $listadoClientes = new Clientes_model();
            $historialRemitos = new Remitos_model();
            $equipos = new Equipos_model();
            if (empty($param))
            {
                $data['active'] = $this->activeMenu;
                $data['clientes'] = $listadoClientes->getClients();
                $data['historial'] = $historialRemitos->getHistorialRemitos();
                $data['equipos'] = $equipos->getEquipments();
                $data['nombre'] = ucfirst($session->nombre);
                echo view('templates/head');
                echo view('templates/header',$data);
                echo view('templates/aside',$data);
                echo view('templates/header_subVentas');
                echo view('ventas/saldos_clientes');
                echo view('templates/footer');  
            }elseif($param == "saldo")
            {
                $idCliente = $this->request->getPost('idCliente');  
    
                $array['cliente'] = $historialRemitos->getSaldoCliente($idCliente);
                print_r(json_encode($array['cliente'])); 
            }
            
            
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }

    }


    public function nuevo_cliente()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['active'] = $this->activeMenu;
            $data['nombre'] = ucfirst($session->nombre);
            echo view('templates/head');
            echo view('templates/header',$data);
            echo view('templates/aside',$data);
            echo view('templates/header_subVentas');
            echo view('ventas/nuevo_cliente');
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
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
                                'descuento' => $this->request->getPost('descuento'),
                                'estado' => 'activo'
                                );
            $cliente->setNewClient($nuevoCliente);
            return redirect()->to('/ventas/nuevo_cliente');

        }else{
        $mensaje = "Su sesion ha expirado!";
        $session->setFlashdata('message',$mensaje);
        return redirect()->to('/login');
        }
    }

    public function editar_cliente($id = NULL)
    {
        if ($id < 1)
        {
           return redirect()->to('/ventas/editarCliente/1');

        }
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['active'] = $this->activeMenu;
            $data['nombre'] = ucfirst($session->nombre);
            $listado = new Clientes_model();
            $array['clientes'] = $listado->getCustomer($id);
            if ($array['equipos'] == NULL)
            {
            return redirect()->to('/equipos/editar/1');
            }    
            echo view('templates/head');
            echo view('templates/header',$data);
            echo view('templates/aside',$data);
            echo view('templates/header_subEquipos');
            echo view('equipos/editar_equipo',$array);
        }
    }

    public function listadoClientes()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['active'] = $this->activeMenu;
            $data['nombre'] = ucfirst($session->nombre);
            $listado = new Clientes_model();
            $array['clientes'] = $listado->getClients(); 
            echo view('templates/head');
            echo view('templates/header',$data);
            echo view('templates/aside',$data);
            echo view('templates/header_subVentas');
            echo view('ventas/listado_clientes',$array);
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



}





?>