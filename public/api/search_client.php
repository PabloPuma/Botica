<?php
require_once __DIR__ . '/../../app/autoload.php';

use App\Controllers\AuthController;
use App\Models\UserDAO; // Assuming UserDAO exists or we'll use a direct DB connection if needed, but better to use a Model. 
// Wait, I should check if UserDAO exists or where users are managed. 
// checking AuthController usually reveals it.

// For now, I'll instantiate AuthController to get DB connection or Model if available, 
// OR simpler: Create a UserDAO or use direct DB class if existing.
// Let's assume we need to access DB. The autoload loads classes.
// Let's assume we can use a simple script first.

header('Content-Type: application/json');
error_reporting(0); // Disable error reporting in output
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

$dni = $_GET['dni'] ?? '';

if (empty($dni)) {
    echo json_encode(['success' => false, 'message' => 'DNI requerido']);
    exit;
}

// Connect to DB (using the app's standard way)
// Use the shared database connection if possible.
// Let's create a temporary instance of a controller or model to get the DB, or just new mysqli like in DAO.
$config = require __DIR__ . '/../../app/Config/Database.php';
$db = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);

if ($db->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión']);
    exit;
}


// Schema: `id`, `nombre`, `dni`, `edad`, `usuario`, `clave`, `correo`
$stmt = $db->prepare("SELECT id, nombre, direccion, telefono, dni FROM usuarios WHERE dni = ? LIMIT 1");
$stmt->bind_param("s", $dni);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'data' => $row]);
} else {
    echo json_encode(['success' => false, 'message' => 'Cliente no encontrado']);
}
