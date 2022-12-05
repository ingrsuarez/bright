<?php

namespace App\Models;


use CodeIgniter\Model;

class Equipos_model extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['numero','serial','capacidad','ubicacion','marca','estado'];

    public function setNewEquipment($data)
    {
        $db = \Config\Database::connect();
        $db->table('equipos')->insert($data);   
        
    }

    public function getEquipments()
    {
        $db = \Config\Database::connect();  
        $query = $db->table('equipos')->get();
        $result = $query->getResult();
        return $result;
    }

    public function getEquipment($id=0)
    {
        $db = \Config\Database::connect();  
        $query = $db->table('equipos')->where('id', $id)->get();
        $result = $query->getResult();
        return $result;
    }
}