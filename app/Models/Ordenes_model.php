<?php

namespace App\Models;


use CodeIgniter\Model;

class Ordenes_model extends Model
{
    protected $table = 'ordenes_servicio';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha','equipo','descripcion','repuestos','usuario','horas','remito','estado'];


    public function setNewOrder($data)
    {
        $db = \Config\Database::connect();
        $db->table('ordenes_servicio')->insert($data);   
        
    }

    public function getOrders()
    {
        $db = \Config\Database::connect();  
        $query = $db->query("SELECT ordenes_servicio.fecha, equipos.numero, ordenes_servicio.descripcion,ordenes_servicio.repuestos, usuarios_internos.usuario, ordenes_servicio.remito, ordenes_servicio.estado FROM ordenes_servicio INNER JOIN usuarios_internos ON ordenes_servicio.usuario =usuarios_internos.id INNER JOIN equipos ON ordenes_servicio.equipo = equipos.id");
        $result = $query->getResult();
        return $result;
    }
}