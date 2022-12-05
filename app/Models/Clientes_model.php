<?php

namespace App\Models;


use CodeIgniter\Model;

class Clientes_model extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha','nombre','cuit','iva','telefono','domicilio','email','descuento','rubro','codigo_postal','estado'];

    public function setNewClient($data)
    {
        $db = \Config\Database::connect();
        $db->table('clientes')->insert($data);   
        
    }

    public function getClients()
    {

        $db = \Config\Database::connect();  
        $query = $db->table('clientes')->get();
        $result = $query->getResult();
        return $result;
    }
}