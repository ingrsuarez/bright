<?php

namespace App\Models;


use CodeIgniter\Model;

class Equipos_model extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['numero','horas','capacidad','ubicacion','marca','estado'];

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

    public function getLastId()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT MAX(ID) as id FROM equipos LIMIT 1');
        $result = $query->getRow();
        return $result;
    }

    public function getAvailableEquipments()
    {
        $db = \Config\Database::connect();  
        $query = $db->table('equipos')->where('estado','disponible')->get();

        $result = $query->getResult();
        return $result;
    }

    public function getWorkingEquipments()
    {
        $db = \Config\Database::connect();  
        $query = $db->table('equipos')->where('estado','servicio')->get();

        $result = $query->getResult();
        return $result;
    }

    public function setEstado($id = NULL, $estado = NULL, $horas = NULL, $ubicacion = NULL)
    {
        $data = [
                    'horas' => $horas,
                    'estado' => $estado,
                    'ubicacion' => $ubicacion
                ];
        $db = \Config\Database::connect();
        $db->table('equipos')->where('id', $id)->update($data);

    }

    public function getAvailablePercentage($estado)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SUM(estado='".$estado."')*100/count(*) as percentage FROM equipos");
        $result = $query->getRow();
        return intval($result->percentage);
    }

}