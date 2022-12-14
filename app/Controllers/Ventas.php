<?php

namespace App\Controllers;
use App\Models\Users_model;
use App\Models\Equipos_model;
use App\Models\Clientes_model;
use App\Models\Remitos_model;
use App\Models\Movimientos_model;


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
                $data['today'] = date("Y-m-d");
                $data['nombre'] = ucfirst($session->usuario);
                
                $data['equipos'] = $listado->getAvailableEquipments(); 
                $clientes = new Clientes_model();
                $data['clientes'] = $clientes->getClients();  
                $data['hora'] = date('H:i');
                echo view('templates/head');
                echo view('templates/header');
                echo view('templates/header_subVentas');
                echo view('templates/aside',$data);
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
                                    'punto_venta' => '01',
                                    'usuario' => $session->id,
                                    'cliente' => $this->request->getPost('cliente'),
                                    'leyenda' => $this->request->getPost('leyenda'),
                                    'domicilio' => $this->request->getPost('domicilio'),
                                    'hora' => $this->request->getPost('hora'),
                                    'estado' => $this->request->getPost('tipo')
                                    );
                
                $remito_id = $remito->setNewRemito($nuevoRemito);
                foreach ($equipos_seleccionados as $key => $value)
                    {
                        $cliente = $remito->getClient($remito_id);
                        $ubicacion = $cliente->nombre;
                        $nuevoMovimiento = array('fecha' => $this->request->getPost('fecha') ,
                                    'usuario' => $session->id,
                                    'equipo' => $value,
                                    'horas' => $horas[$key],
                                    'capacidad' => $capacidad[$key],
                                    'ubicacion' => strtoupper($ubicacion),
                                    'cliente' => strtoupper($this->request->getPost('cliente')),
                                    'remito' => $remito_id,
                                    'transporte' => $this->request->getPost('transporte'),
                                    'tipo' => $this->request->getPost('tipo')
                                    );
                        $movimiento->setNewMovimiento($nuevoMovimiento);
                        if($this->request->getPost('tipo') == 'salida'){
                            $estado = 'servicio';
                        }else{
                            $estado = 'revision';
                            $ubicacion = 'base';
                        }

                        $equipo->setEstado($value,$estado,$horas[$key],$ubicacion);                    
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
            $data['nombre'] = ucfirst($session->usuario);
            $listadoRemitos = new Remitos_model();
            $array['remitos'] = $listadoRemitos->getRemitosView(); 
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subVentas');
            echo view('templates/aside',$data);
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

    public function listadoClientes()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->usuario);
            $listado = new Clientes_model();
            $array['clientes'] = $listado->getClients(); 
            echo view('templates/head');
            echo view('templates/header');
            echo view('templates/header_subVentas');
            echo view('templates/aside',$data);
            echo view('ventas/listado_clientes',$array);
            echo view('templates/footer');
        }else{
            $mensaje = "Su sesion ha expirado!";
            $session->setFlashdata('message',$mensaje);
            return redirect()->to('/login');
        }


    }





}





?>