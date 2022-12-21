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
                    $nuevoMovimiento = array('fecha' => $this->request->getPost('fecha') ,
                                'usuario' => $session->id,
                                'equipo' => $value,
                                'horas' => $horas[$key],
                                'capacidad' => $capacidad[$key],
                                'ubicacion' => $this->request->getPost('domicilio'),
                                'remito' => $remito_id,
                                'transporte' => $this->request->getPost('transporte'),
                                'tipo' => $this->request->getPost('tipo')
                                );
                    $movimiento->setNewMovimiento($nuevoMovimiento);
                    if($this->request->getPost('tipo') == 'salida'){
                        $estado = 'servicio';
                    }else{
                        $estado = 'disponible';
                    }
                    $equipo->setEstado($value,$estado,$horas[$key]);                    
                } 
                echo "
                <script>
                    window.open('http://localhost/bright/ventas/pdfRemito/".$remito_id."', '_blank');
                    alert('There are no fields to generate a report');
                    window.open('http://localhost/bright/ventas/nuevo_remito/','_self');
                </script>
                ";
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
        // var_dump($data['movimientos']);
        echo view('ventas/pdf_remito',$data);
        // if (!empty($data['idprov']))
        // {
        //     $data['numero'] = $this->input->post('ocselect');
        //     $ocNumber = $this->input->post('ocselect');
        //     if (!empty($ocNumber))
        //     {
        //         $data['items'] = $this->Compras_model->oc_items($ocNumber);//Fila
        //         //Send selected proveedor
        //         $data['filaprov'] = $this->Compras_model->select_proveedor($data['idprov']);
        //         $this->load->view('compras/pdfoc',$data);
        //     }else
        //     {
        //         //User didn´t select order! 
        //         $mensaje = "Por favor seleccione una orden de compra!";
        //         echo ("<script>
        //         alert('".$mensaje."')</script>");
        //         redirect('/compras/imprimirOC/', 'refresh');
        //     }
        // }else
        // {
        //     //User didn´t select supplier!  
        //     $mensaje = "Por favor seleccione un proveedor!";
        //     echo ("<script>
        //     alert('".$mensaje."')</script>");
        //     redirect('/compras/imprimirOC/', 'refresh');
        // }
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