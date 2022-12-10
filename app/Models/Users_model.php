<?php

namespace App\Models;


use CodeIgniter\Model;

class Users_model extends Model
{
    protected $table = 'usuarios_internos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre','apellido','mail','telefono','fecha_ingreso','horas_semanales','fecha_nacimiento','cuil','dni','domicilio'];

    public function getUserPassword($user_name,$password)
    {
        $db = \Config\Database::connect();
        $encrypt_password = hash('sha256',$password);   
        $query   = $db->query("SELECT * FROM usuarios_internos WHERE usuario = '".$user_name."' AND clave = '".$encrypt_password."'");
        $user = $query->getResult();
        return $user;
    }

    public function setNewUser($data)
    {
        $db = \Config\Database::connect();
        $db->table('usuarios_internos')->insert($data);   
        
    }

    public function getUsers()
    {

        $db = \Config\Database::connect();  
        $query = $db->table('usuarios_internos')->get();
        $result = $query->getResult();
        return $result;
    }

    public function getUser($id=0)
    {

        $db = \Config\Database::connect();  
        $query = $db->table('usuarios_internos')->where('id', $id)->get();
        $result = $query->getResult();
        return $result;
    }

    public function getLastId()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT MAX(ID) as id FROM usuarios_internos LIMIT 1');
        $result = $query->getRow();
        return $result;
    }
}