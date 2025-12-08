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
        // 1. Verificar Stock Disponible
        $stmtStock = $this->db->prepare("SELECT cantidad, nombre FROM productos WHERE id = ?");
        $stmtStock->bind_param("i", $productId);
        $stmtStock->execute();
        $resStock = $stmtStock->get_result();
        if ($resStock->num_rows === 0) return false; // Producto no existe
        $prodData = $resStock->fetch_assoc();
        $stockDisponible = $prodData['cantidad'];
        $nombreProducto = $prodData['nombre'];

        // 2. Verificar cantidad actual en carrito
        $stmtCart = $this->db->prepare("SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
        $stmtCart->bind_param("ii", $userId, $productId);
        $stmtCart->execute();
        $resCart = $stmtCart->get_result();
        
        $cantidadActualEnCarrito = 0;
        if ($resCart->num_rows > 0) {
            $cantidadActualEnCarrito = $resCart->fetch_assoc()['cantidad'];
        }

        // 3. Validar si excede el stock
        if (($cantidadActualEnCarrito + $quantity) > $stockDisponible) {
            return "Stock insuficiente para $nombreProducto. Disponible: $stockDisponible";
        }

        // 4. Insertar o Actualizar
        if ($resCart->num_rows > 0) {
            $stmt = $this->db->prepare("UPDATE carrito SET cantidad = cantidad + ? WHERE id_usuario = ? AND id_producto = ?");
            $stmt->bind_param("iii", $quantity, $userId, $productId);
        } else {
            $stmt = $this->db->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $userId, $productId, $quantity);
        }
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateCartQuantity($userId, $productId, $quantity) {
        if ($quantity > 0) {
            // Validar Stock antes de actualizar
            $stmtStock = $this->db->prepare("SELECT cantidad, nombre FROM productos WHERE id = ?");
            $stmtStock->bind_param("i", $productId);
            $stmtStock->execute();
            $resStock = $stmtStock->get_result();
            if ($resStock->num_rows === 0) return false;
            $prodData = $resStock->fetch_assoc();
            $stockDisponible = $prodData['cantidad'];
            $nombreProducto = $prodData['nombre'];

            if ($quantity > $stockDisponible) {
                return "Stock insuficiente para $nombreProducto. Máximo disponible: $stockDisponible";
            }

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
    public function createSale($cartOwnerId, $subtotal, $items, $deliveryMethod = 'tienda', $saleOwnerId = null) {
        $this->db->begin_transaction();

        try {
            // Determine who the sale belongs to (CLIENT): 
            $finalUserId = $saleOwnerId ? $saleOwnerId : $cartOwnerId;
            
            // Determine who created the sale (SELLER):
            // If admin/vendor is selling ($saleOwnerId used), then $cartOwnerId is the Seller.
            // If client is buying for themselves ($saleOwnerId null), then Seller is same as Client (or null/system).
            // Logic: Store $cartOwnerId as id_vendedor if it's different from $finalUserId, or just always store it as the creator.
            $sellerId = $cartOwnerId; 

            // Calcular costo de delivery
            $costoDelivery = ($deliveryMethod === 'delivery') ? 8.00 : 0.00;
            $total = $subtotal + $costoDelivery;

            // 1. Crear registro de venta (Updated to include id_vendedor)
            $stmt = $this->db->prepare("INSERT INTO ventas (id_usuario, id_vendedor, total, metodo_entrega, costo_delivery, fecha) VALUES (?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("iidsd", $finalUserId, $sellerId, $total, $deliveryMethod, $costoDelivery);
            $stmt->execute();
            $saleId = $this->db->insert_id;

            // 2. Agregar detalles de venta y actualizar stock
            $stmtDetail = $this->db->prepare("INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
            $stmtStock = $this->db->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE id = ?");

            foreach ($items as $item) {
                // Verificacion final de stock
                $stmtCheck = $this->db->prepare("SELECT cantidad, nombre FROM productos WHERE id = ?");
                $stmtCheck->bind_param("i", $item['id_producto']);
                $stmtCheck->execute();
                $resCheck = $stmtCheck->get_result();
                $currentStock = $resCheck->fetch_assoc();

                if ($currentStock['cantidad'] < $item['cantidad']) {
                     throw new \Exception("Stock insuficiente para el producto: " . $currentStock['nombre'] . ". Disponible: " . $currentStock['cantidad']);
                }

                $stmtDetail->bind_param("iiid", $saleId, $item['id_producto'], $item['cantidad'], $item['precio']);
                $stmtDetail->execute();

                $stmtStock->bind_param("ii", $item['cantidad'], $item['id_producto']);
                $stmtStock->execute();
            }

            // 3. Limpiar carrito del usuario que TIENE el carrito
            $this->clearCart($cartOwnerId);

            $this->db->commit();
            return $saleId;
        } catch (\Exception $e) {
            $this->db->rollback();
            return $e->getMessage();
        }
    }

    // Operaciones de Historial y Exportación
    public function getSalesHistory($filters = []) {
        $sql = "SELECT v.id, v.fecha, v.total, 
                u_cliente.nombre as cliente_nombre, u_cliente.rol as cliente_rol, u_cliente.usuario as cliente_usuario,
                u_vendedor.nombre as vendedor_nombre, u_vendedor.rol as vendedor_rol, u_vendedor.usuario as vendedor_usuario
                FROM ventas v 
                JOIN usuarios u_cliente ON v.id_usuario = u_cliente.id 
                LEFT JOIN usuarios u_vendedor ON v.id_vendedor = u_vendedor.id
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

        // Filtrar por ID de usuario específico (cliente)
        if (!empty($filters['user_id'])) {
            $sql .= " AND v.id_usuario = ?";
            $types .= "i";
            $params[] = $filters['user_id'];
        }

        // Filtrar por Rol (del cliente)
        if (!empty($filters['role'])) {
            $sql .= " AND u_cliente.rol = ?";
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

    public function getSaleById($saleId) {
        $stmt = $this->db->prepare("
            SELECT v.*, 
                   u.nombre as cliente_nombre, u.dni as cliente_dni, u.direccion as cliente_direccion,
                   s.nombre as vendedor_nombre, s.rol as vendedor_rol
            FROM ventas v
            JOIN usuarios u ON v.id_usuario = u.id
            LEFT JOIN usuarios s ON v.id_vendedor = s.id
            WHERE v.id = ?
        ");
        $stmt->bind_param("i", $saleId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getSaleDetails($saleId) {
        $stmt = $this->db->prepare("
            SELECT dv.*, p.nombre as producto_nombre
            FROM detalle_ventas dv
            JOIN productos p ON dv.id_producto = p.id
            WHERE dv.id_venta = ?
        ");
        $stmt->bind_param("i", $saleId);
        $stmt->execute();
        return $stmt->get_result();
    }
}
