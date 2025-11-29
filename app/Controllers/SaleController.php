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

    public function checkout($userId) {
        $cart = $this->salesDAO->getCartByUserId($userId);
        $items = [];
        $total = 0;

        while ($row = $cart->fetch_assoc()) {
            $items[] = $row;
            $total += $row['precio'] * $row['cantidad'];
        }

        if (empty($items)) {
            return "El carrito está vacío.";
        }

        $saleId = $this->salesDAO->createSale($userId, $total, $items);
        if ($saleId) {
            // Log successful sale
            Logger::getInstance()->logSale($userId, $saleId, $total);
            return $saleId;
        }
        return "Error al procesar la venta.";
    }
}
