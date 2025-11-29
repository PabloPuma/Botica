<?php
/**
 * Database Schema Fix Script
 * Run this once to create missing tables for sales functionality
 * 
 * Usage: php public/fix_db_schema.php
 */

require_once __DIR__ . '/../app/autoload.php';

use App\Config\Database;

$db = Database::getInstance()->getConnection();

echo "Starting database schema fixes...\n\n";

// Create ventas table
$sql_ventas = "CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if ($db->query($sql_ventas)) {
    echo "✓ Table 'ventas' created or already exists\n";
} else {
    echo "✗ Error creating 'ventas' table: " . $db->error . "\n";
}

// Create detalle_ventas table
$sql_detalle = "CREATE TABLE IF NOT EXISTS `detalle_ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_venta` (`id_venta`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if ($db->query($sql_detalle)) {
    echo "✓ Table 'detalle_ventas' created or already exists\n";
} else {
    echo "✗ Error creating 'detalle_ventas' table: " . $db->error . "\n";
}

// Create carrito table if it doesn't exist
$sql_carrito = "CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_product` (`id_usuario`, `id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if ($db->query($sql_carrito)) {
    echo "✓ Table 'carrito' created or already exists\n";
} else {
    echo "✗ Error creating 'carrito' table: " . $db->error . "\n";
}

// Add cantidad column to productos if it doesn't exist
$check_column = $db->query("SHOW COLUMNS FROM `productos` LIKE 'cantidad'");
if ($check_column->num_rows == 0) {
    $sql_add_cantidad = "ALTER TABLE `productos` ADD COLUMN `cantidad` int(11) NOT NULL DEFAULT 0";
    if ($db->query($sql_add_cantidad)) {
        echo "✓ Column 'cantidad' added to 'productos' table\n";
    } else {
        echo "✗ Error adding 'cantidad' column: " . $db->error . "\n";
    }
} else {
    echo "✓ Column 'cantidad' already exists in 'productos' table\n";
}

echo "\nDatabase schema fixes completed!\n";
echo "You can now delete this file if you wish.\n";
