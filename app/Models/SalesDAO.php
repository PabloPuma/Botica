<?php
namespace App\Models;

use App\Config\Database;

class SalesDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Operaciones del Carrito
    public function getCartByUserId($userId) {
        $stmt = $this->db->prepare("
            SELECT c.id_producto, c.cantidad, p.nombre, p.precio, p.imagen 
            FROM carrito c 
            JOIN productos p ON c.id_producto = p.id 
            WHERE c.id_usuario = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function addToCart($userId, $productId, $quantity) {
        // Verificar si existe
        $stmt = $this->db->prepare("SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $stmt = $this->db->prepare("UPDATE carrito SET cantidad = cantidad + ? WHERE id_usuario = ? AND id_producto = ?");
            $stmt->bind_param("iii", $quantity, $userId, $productId);
        } else {
            $stmt = $this->db->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $userId, $productId, $quantity);
        }
        return $stmt->execute();
    }

    public function updateCartQuantity($userId, $productId, $quantity) {
        if ($quantity > 0) {
            $stmt = $this->db->prepare("UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?");
            $stmt->bind_param("iii", $quantity, $userId, $productId);
        } else {
            return $this->removeFromCart($userId, $productId);
        }
        return $stmt->execute();
    }

    public function removeFromCart($userId, $productId) {
        $stmt = $this->db->prepare("DELETE FROM carrito WHERE id_usuario = ? AND id_producto = ?");
        $stmt->bind_param("ii", $userId, $productId);
        return $stmt->execute();
    }

    public function clearCart($userId) {
        $stmt = $this->db->prepare("DELETE FROM carrito WHERE id_usuario = ?");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

    // Operaciones de Checkout
    public function createSale($userId, $subtotal, $items, $deliveryMethod = 'tienda') {
        $this->db->begin_transaction();

        try {
            // Calcular costo de delivery
            $costoDelivery = ($deliveryMethod === 'delivery') ? 8.00 : 0.00;
            $total = $subtotal + $costoDelivery;

            // 1. Crear registro de venta
            $stmt = $this->db->prepare("INSERT INTO ventas (id_usuario, total, metodo_entrega, costo_delivery, fecha) VALUES (?, ?, ?, ?, NOW())");
            $stmt->bind_param("idsd", $userId, $total, $deliveryMethod, $costoDelivery);
            $stmt->execute();
            $saleId = $this->db->insert_id;

            // 2. Agregar detalles de venta y actualizar stock
            $stmtDetail = $this->db->prepare("INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
            $stmtStock = $this->db->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE id = ?");

            foreach ($items as $item) {
                $stmtDetail->bind_param("iiid", $saleId, $item['id_producto'], $item['cantidad'], $item['precio']);
                $stmtDetail->execute();

                $stmtStock->bind_param("ii", $item['cantidad'], $item['id_producto']);
                $stmtStock->execute();
            }

            // 3. Limpiar carrito
            $this->clearCart($userId);

            $this->db->commit();
            return $saleId;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }
    // Operaciones de Historial y Exportación
    public function getSalesHistory($filters = []) {
        $sql = "SELECT v.id, v.fecha, v.total, u.nombre as usuario_nombre, u.rol, u.usuario 
                FROM ventas v 
                JOIN usuarios u ON v.id_usuario = u.id 
                WHERE 1=1";
        
        $types = "";
        $params = [];

        // Filtrar por rango de fechas
        if (!empty($filters['start_date'])) {
            $sql .= " AND DATE(v.fecha) >= ?";
            $types .= "s";
            $params[] = $filters['start_date'];
        }
        if (!empty($filters['end_date'])) {
            $sql .= " AND DATE(v.fecha) <= ?";
            $types .= "s";
            $params[] = $filters['end_date'];
        }

        // Filtrar por ID de usuario específico (para vista de Cliente/Vendedor o filtro de Admin)
        if (!empty($filters['user_id'])) {
            $sql .= " AND v.id_usuario = ?";
            $types .= "i";
            $params[] = $filters['user_id'];
        }

        // Filtrar por Rol (vista de Admin)
        if (!empty($filters['role'])) {
            $sql .= " AND u.rol = ?";
            $types .= "s";
            $params[] = $filters['role'];
        }

        $sql .= " ORDER BY v.fecha DESC";

        $stmt = $this->db->prepare($sql);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        return $stmt->get_result();
    }
}
