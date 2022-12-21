<?php

namespace App\Models;


use CodeIgniter\Model;

class Remitos_model extends Model
{
    protected $table = 'remitos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha','punto_venta','usuario','cliente','leyenda','domicilio','hora','estado'];

    public function setNewRemito($data)
    {
        $db = \Config\Database::connect();
        $db->table('remitos')->insert($data); 
        $id = $db->insertID();  
        return $id;
        
    }

    public function getRemitos()
    {

        $db = \Config\Database::connect();  
        $query = $db->table('remitos')->get();
        $result = $query->getResult();
        return $result;
    }

    public function getClient($numeroRemito)
    {
        $db = \Config\Database::connect();
        $query   = $db->query("SELECT cliente FROM remitos WHERE id = '".$numeroRemito."'");
        $cliente = $query->getRow();
        $query   = $db->query("SELECT * FROM clientes WHERE id = '".$cliente->cliente."'");
        $nombreCliente = $query->getRow();
        return $nombreCliente;

    }

    public function getRemito($numeroRemito)
    {
        $db = \Config\Database::connect();
        $query   = $db->query("SELECT * FROM remitos WHERE id = '".$numeroRemito."'");
        $remito = $query->getRow();
        return $remito;

    }

    public function getMovimientos($numeroRemito)
    {
        $db = \Config\Database::connect();
        $query   = $db->query("SELECT * FROM `movimientos` WHERE `remito` = '".$numeroRemito."'");
        $movimientos = $query->getResult();
        return $movimientos;

    }
}