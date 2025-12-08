<?php
namespace App\Controllers;

use App\Models\SalesDAO;
use App\Models\Logger;

class SaleController {
    private $salesDAO;

    public function __construct() {
        $this->salesDAO = new SalesDAO();
    }

    public function getCart($userId) {
        return $this->salesDAO->getCartByUserId($userId);
    }

    public function addToCart($userId, $productId, $quantity) {
        if ($quantity <= 0) return "Cantidad inválida.";
        return $this->salesDAO->addToCart($userId, $productId, $quantity);
    }

    public function updateCartItem($userId, $productId, $quantity) {
        return $this->salesDAO->updateCartQuantity($userId, $productId, $quantity);
    }

    public function removeFromCart($userId, $productId) {
        return $this->salesDAO->removeFromCart($userId, $productId);
    }

    public function checkout($userId, $deliveryMethod = 'tienda') {
        $cart = $this->salesDAO->getCartByUserId($userId);
        
        $subtotal = 0;
        $items = [];
        
        while ($row = $cart->fetch_assoc()) {
            $subtotal += $row['precio'] * $row['cantidad'];
            $items[] = $row;
        }

        if (empty($items)) {
            return "El carrito está vacío.";
        }

        // Check if a specific client is being assigned (Admin/Vendor use case)
        $saleOwnerId = null;
        if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
            $saleOwnerId = (int)$_POST['client_id'];
        }

        // El cálculo del total (con delivery) se hace en SalesDAO::createSale()
        $saleId = $this->salesDAO->createSale($userId, $subtotal, $items, $deliveryMethod, $saleOwnerId);
        
        if (is_numeric($saleId)) {
            // Calcular total final para el log
            $costoDelivery = ($deliveryMethod === 'delivery') ? 8.00 : 0.00;
            $totalFinal = $subtotal + $costoDelivery;
            
            Logger::getInstance()->logSale($userId, $saleId, $totalFinal);
            return $saleId;
        }
        return $saleId; // Return error message
    }

    public function showReceipt($saleId) {
        $sale = $this->salesDAO->getSaleById($saleId);
        if (!$sale) {
            die("Venta no encontrada.");
        }
        $detalles = $this->salesDAO->getSaleDetails($saleId);
        
        // Cargar vista de boleta
        require __DIR__ . '/../Views/sale/boleta.php';
    }
}
