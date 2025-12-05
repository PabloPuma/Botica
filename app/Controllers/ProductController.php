<?php
namespace App\Controllers;

use App\Models\ProductDAO;

class ProductController {
    private $productDAO;

    public function __construct() {
        $this->productDAO = new ProductDAO();
    }

    public function index() {
        return $this->productDAO->getAll();
    }

    public function create($data) {
        $nombre = $data['nombre'];
        $categoria = $data['categoria'];
        $precio = $data['precio'];
        $cantidad = $data['cantidad'];
        
        // Validación
        if (empty($nombre) || $precio <= 0 || $cantidad < 0) {
            return "Datos inválidos.";
        }

        if ($this->productDAO->create($nombre, $categoria, $precio, $cantidad)) {
            // Registrar historial si es necesario
            return true;
        }
        return "Error al crear producto.";
    }

    public function addStock($id, $cantidad) {
        if ($cantidad <= 0) return "Cantidad debe ser mayor a 0.";
        
        if ($this->productDAO->updateStock($id, $cantidad)) {
            $this->productDAO->logStockHistory($id, 'entrada', $cantidad);
            return true;
        }
        return "Error al actualizar stock.";
    }
}
