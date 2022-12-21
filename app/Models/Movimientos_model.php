<?php

namespace App\Models;


use CodeIgniter\Model;

class Movimientos_model extends Model
{
    protected $table = 'movimientos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha','usuario','equipo','horas','capacidad','ubicacion','remito','transporte','tipo','estado'];

    public function setNewMovimiento($data)
    {
        $db = \Config\Database::connect();
        $db->table('movimientos')->insert($data);   
        
    }

    public function getMovimientos()
    {

        $db = \Config\Database::connect();  
        $query = $db->table('movimientos')->get();
        $result = $query->getResult();
        return $result;
    }
}