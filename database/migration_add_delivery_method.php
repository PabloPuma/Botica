<?php
require_once __DIR__ . '/../app/Config/Database.php';

use App\Config\Database;

$db = Database::getInstance()->getConnection();

$sql = "ALTER TABLE ventas ADD COLUMN metodo_entrega ENUM('tienda', 'delivery') DEFAULT 'tienda'";

if ($db->query($sql)) {
    echo "Migration successful: Added 'metodo_entrega' column to 'ventas' table.\n";
} else {
    echo "Migration failed or column already exists: " . $db->error . "\n";
}
