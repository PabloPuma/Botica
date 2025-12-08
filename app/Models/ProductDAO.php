<?php
namespace App\Models;

use App\Config\Database;

class ProductDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM productos ORDER BY cantidad ASC");
        return $result;
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($nombre, $categoria, $precio, $cantidad, $imagen = 'images/default.jpg') {
        $stmt = $this->db->prepare("INSERT INTO productos (nombre, categoria, precio, cantidad, imagen) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $nombre, $categoria, $precio, $cantidad, $imagen);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }

    public function updateStock($id, $cantidad) {
        $stmt = $this->db->prepare("UPDATE productos SET cantidad = cantidad + ? WHERE id = ?");
        $stmt->bind_param("ii", $cantidad, $id);
        return $stmt->execute();
    }
    
    public function logStockHistory($producto_id, $tipo_movimiento, $cantidad, $usuario_id = 1) {
        // Corrected query to match table structure: id_producto instead of producto_id, and removed usuario_id
        $stmt = $this->db->prepare("INSERT INTO historial_stock (id_producto, tipo_movimiento, cantidad, fecha) VALUES (?, ?, ?, NOW())");
        if (!$stmt) {
             // Basic error handling if prepare fails
             return false;
        }
        $stmt->bind_param("isi", $producto_id, $tipo_movimiento, $cantidad);
        return $stmt->execute();
    }
}
