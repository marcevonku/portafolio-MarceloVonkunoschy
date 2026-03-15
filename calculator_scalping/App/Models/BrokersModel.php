<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class BrokersModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function obtenerTodos()
    {
        $stmt = $this->db->query("SELECT * FROM brokers WHERE activo = 1 ORDER BY nombreBroker ASC");
        return $stmt->fetchAll();
    }

    public function insertar($data)
    {
        $sql = "INSERT INTO brokers (nombreBroker, comisionCompra, derechoMercado, ivaImpuesto, activo, fec_registro) 
                VALUES (:nombre, :comision, :derecho, :iva, :activo, NOW())";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':nombre' => $data['nombreBroker'],
            ':comision' => $data['comisionCompra'],
            ':derecho' => $data['derechoMercado'],
            ':iva' => $data['ivaImpuesto'],
            ':activo' => $data['activo'] ?? 1
        ]);

        return $this->db->lastInsertId();
    }

    public function actualizar($data)
    {
        if (!isset($data['id']))
            return false;

        $sql = "UPDATE brokers SET 
                nombreBroker = :nombre, 
                comisionCompra = :comision,
                derechoMercado = :derecho,
                ivaImpuesto = :iva,
                activo = :activo,
                fec_modificado = NOW()
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nombre' => $data['nombreBroker'],
            ':comision' => $data['comisionCompra'],
            ':derecho' => $data['derechoMercado'],
            ':iva' => $data['ivaImpuesto'],
            ':activo' => $data['activo'] ?? 1,
            ':id' => $data['id']
        ]);
    }

    public function actualizarEstado($id, $estado)
    {
        $stmt = $this->db->prepare("UPDATE brokers SET activo = :estado WHERE id = :id");
        return $stmt->execute([':id' => $id, ':estado' => $estado]);
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM brokers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}
