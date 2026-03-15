<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class OperacionesModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function obtenerTodas()
    {
        $stmt = $this->db->query("SELECT o.*, b.nombreBroker 
                                  FROM operaciones o
                                  LEFT JOIN brokers b ON o.broker_id = b.id 
                                  ORDER BY o.fecha_operacion DESC");
        return $stmt->fetchAll();
    }

    public function insertar($data)
    {
        // Se asume que $data contiene las claves exactas que coinciden con las columnas
        $sql = "INSERT INTO operaciones (
                    tasa_banco, tn_365, tn_260, broker_id, nombre_accion, cantidad_acciones,
                    valor_neto_compra, valor_comision_compra, derecho_mercado_compra, iva_compra,
                    valor_bruto_compra, ganancia_neta_por_accion, precio_neto_venta,
                    valor_comision_venta, derecho_mercado_venta, iva_venta,
                    precio_bruto_venta, ganancia_neta_total, fecha_operacion_venta, vigente,
                    comision_porcentaje, derecho_mercado_porcentaje, iva_porcentaje, ganancia_proyectada_porcentaje
                ) VALUES (
                    :tasa_banco, :tn_365, :tn_260, :broker_id, :nombre_accion, :cantidad_acciones,
                    :valor_neto_compra, :valor_comision_compra, :derecho_mercado_compra, :iva_compra,
                    :valor_bruto_compra, :ganancia_neta_por_accion, :precio_neto_venta,
                    :valor_comision_venta, :derecho_mercado_venta, :iva_venta,
                    :precio_bruto_venta, :ganancia_neta_total, :fecha_operacion_venta, :vigente,
                    :comision_porcentaje, :derecho_mercado_porcentaje, :iva_porcentaje, :ganancia_proyectada_porcentaje
                )";

        $stmt = $this->db->prepare($sql);

        // Mapeo básico: asegurarse que tu controlador envíe este array asociativo
        $stmt->execute($data);

        return $this->db->lastInsertId();
    }

    public function actualizarEstado($id, $vigente)
    {
        $stmt = $this->db->prepare("UPDATE operaciones SET vigente = :vigente WHERE id = :id");
        return $stmt->execute(['vigente' => $vigente, 'id' => $id]);
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM operaciones WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
