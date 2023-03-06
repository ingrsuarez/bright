<?php

namespace App\Controllers;
use App\Models\Users_model;
use App\Models\Equipos_model;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        if ($session->has('usuario'))
        {
            $data['nombre'] = ucfirst($session->nombre);
            $equipos = new Equipos_model();
            $disponible = $equipos->getAvailablePercentage('disponible');
            $servicio = $equipos->getAvailablePercentage('servicio');
            $revision = $equipos->getAvailablePercentage('inspeccionar');
            $graph['equipos'] = array($disponible,$servicio,$revision);
            echo view('templates/head');
            echo view('templates/headerImage');
            echo view('templates/aside',$data);
            echo view('templates/bar_graph',$graph);
            echo view('templates/footer');

        }else{    
            $user = new Users_model();
            $name= $this->request->getPost('username');
            $password = $this->request->getPost('password');
           
            if (empty($name))
            {
                $mensaje = "Por favor introduzca un nombre de usuario!";
                $session->setFlashdata('message',$mensaje);
                return redirect()->to('/login');

            }
            if (empty($password))
            {
                $mensaje = "Por favor introduzca una clave válida!";
                $session->setFlashdata('message',$mensaje);
                return redirect()->to('/login');

            }
            $user_data = $user->getUserPassword($name,$password);
            if (!empty($user_data))
            {
              
                $new_session = (array)$user_data[0];
                $session->set($new_session);    
                $data['nombre'] = ucfirst($session->nombre);
                $equipos = new Equipos_model();
                $disponible = $equipos->getAvailablePercentage('disponible');
                $servicio = $equipos->getAvailablePercentage('servicio');
                $revision = $equipos->getAvailablePercentage('inspeccionar');
                $graph['equipos'] = array($disponible,$servicio,$revision);
                echo view('templates/head');
                echo view('templates/headerImage');
                echo view('templates/aside',$data);
                echo view('templates/bar_graph',$graph);
                echo view('templates/footer');
            }else
            {

                $mensaje = "Su sesion ha expirado!";
                $session->setFlashdata('message',$mensaje);
                return redirect()->to('/login');
            }            
        }        
    }





}
