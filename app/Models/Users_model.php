<?php

namespace App\Models;


use CodeIgniter\Model;

class Users_model extends Model
{
    protected $table = 'usuarios_internos';
    

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
}