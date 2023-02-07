<?php

namespace App\Models;


use CodeIgniter\Model;

class Remitos_model extends Model
{
    protected $table = 'remitos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha','numero','punto_venta','usuario','cliente','leyenda','cargos','domicilio','hora','estado'];

    public function setNewRemito($data)
    {
        $db = \Config\Database::connect();
        $db->table('remitos')->insert($data); 
        $id = $db->insertID();  
        return $id;
        
    }

    public function setEstadoRemito($id,$estado)
    {
        $data = [
                    'estado' => $estado,
                ];
        $db = \Config\Database::connect();
        $db->table('remitos')->where('id', $id)->update($data);
    }

    public function setCargosRemito($id,$cargos)
    {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE `remitos` SET `cargos` = CONCAT(`cargos`,' -".$cargos."') WHERE `id`=".$id);

    }

    public function updateRemito($id,$data)
    {

        $db = \Config\Database::connect();
        $db->table('remitos')->where('id', $id)->update($data);

    }

    public function getRemitos()
    {

        $db = \Config\Database::connect();  
        $query = $db->table('remitos')->get();
        $result = $query->getResult();
        return $result;
    }

    public function getRemitosView()
    {

        $db = \Config\Database::connect();  
        $query = $db->table('remitos_view')->orderBy('id', 'DESC')->get();
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
        $query   = $db->query("SELECT * FROM remitos_view WHERE id = '".$numeroRemito."'");
        $remito = $query->getRow();
        return $remito;

    }

    public function getLastRemito()
    {
        $db = \Config\Database::connect();
        $query   = $db->query("SELECT MAX(remitos.numero) AS ultimo FROM `remitos`");
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

    public function getHistorialRemitos()
    {

        $db = \Config\Database::connect();  
        $query = $db->table('historial_remitos')->orderBy('remito', 'DESC')->groupBy('remito')->get();
        $result = $query->getResult();
        return $result;
    }

    public function getSaldoCliente($idCliente)
    {

        $db = \Config\Database::connect();  
        $query = $db->table('historial_remitos')->where('id_cliente',$idCliente)->orderBy('fecha', 'DESC')->groupBy('remito')->get();
        $result = $query->getResult();
        return $result;
    }

    public function getRemitosPercentage($estado)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT SUM(estado='".$estado."')*100/count(*) as percentage FROM pendiente_remitos ");
        $result = $query->getRow();
        if(empty($result))
            { return intval('0');}
        return intval($result->percentage);
    }
}