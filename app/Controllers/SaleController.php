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
        $items = [];
        $subtotal = 0;

        while ($row = $cart->fetch_assoc()) {
            $items[] = $row;
            $subtotal += $row['precio'] * $row['cantidad'];
        }

        if (empty($items)) {
            return "El carrito está vacío.";
        }

        // El cálculo del total (con delivery) se hace en SalesDAO::createSale()
        $saleId = $this->salesDAO->createSale($userId, $subtotal, $items, $deliveryMethod);
        
        if ($saleId) {
            // Calcular total final para el log
            $costoDelivery = ($deliveryMethod === 'delivery') ? 8.00 : 0.00;
            $totalFinal = $subtotal + $costoDelivery;
            
            Logger::getInstance()->logSale($userId, $saleId, $totalFinal);
            return $saleId;
        }
        return "Error al procesar la venta.";
    }
}
