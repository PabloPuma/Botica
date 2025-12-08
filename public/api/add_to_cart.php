<?php
/**
 * AJAX Endpoint for Adding Products to Cart
 * Returns JSON response
 */

session_start();
require_once __DIR__ . '/../../app/autoload.php';

use App\Controllers\SaleController;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$id_producto = $_POST['id_producto'] ?? null;
$cantidad = (int)($_POST['cantidad'] ?? 1);

if (!$id_producto) {
    echo json_encode(['success' => false, 'message' => 'Producto no especificado']);
    exit;
}

$saleController = new SaleController();

$result = $saleController->addToCart($id_usuario, $id_producto, $cantidad);

if ($result === true) {
    echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito']);
} elseif (is_string($result)) {
    echo json_encode(['success' => false, 'message' => $result]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al agregar al carrito']);
}
