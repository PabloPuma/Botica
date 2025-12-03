<?php
// Script para limpiar logs antiguos
require_once __DIR__ . '/../app/autoload.php';
use App\Config\Database;

echo "[INFO] Iniciando limpieza de logs...\n";

try {
    $db = Database::getInstance()->getConnection();
    
    // Eliminar logs mayores a 90 días
    $days = 90;
    $date = date('Y-m-d H:i:s', strtotime("-{$days} days"));
    
    $stmt = $db->prepare("DELETE FROM logs WHERE fecha < ?");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    
    $affected = $stmt->affected_rows;
    
    echo "[SUCCESS] Se eliminaron {$affected} registros de logs antiguos (anteriores a {$date}).\n";
    
} catch (Exception $e) {
    echo "[ERROR] " . $e->getMessage() . "\n";
    exit(1);
}
