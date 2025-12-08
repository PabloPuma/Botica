<?php
require_once __DIR__ . '/../../app/autoload.php';

use App\Helpers\Security;

header('Content-Type: application/json');
error_reporting(0); // Disable error reporting in output
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$dni = $_POST['dni'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$telefono = $_POST['telefono'] ?? '';

if (empty($dni) || empty($nombre)) {
    echo json_encode(['success' => false, 'message' => 'DNI y Nombre son obligatorios']);
    exit;
}

// DB Connection
use App\Config\Database;
$db = Database::getInstance()->getConnection();

if ($db->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $db->connect_error]);
    exit;
}

// Check existence
$stmt = $db->prepare("SELECT id FROM usuarios WHERE dni = ?");
$stmt->bind_param("s", $dni);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'El DNI ya está registrado']);
    exit;
}

// Create User
// Default password: dni
$claveHash = password_hash($dni, PASSWORD_DEFAULT);
$usuario = $dni; // User is dni
$rol = 'cliente';

$stmt = $db->prepare("INSERT INTO usuarios (nombre, dni, usuario, clave, direccion, telefono, rol) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $nombre, $dni, $usuario, $claveHash, $direccion, $telefono, $rol);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'id' => $db->insert_id, 'message' => 'Cliente registrado exitosamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar cliente']);
}
