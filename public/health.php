<?php
/**
 * Health Check Endpoint
 * Verifica el estado de la aplicación y sus dependencias
 * 
 * Uso: http://localhost/dashboard/Botica/health.php
 */

require_once __DIR__ . '/../app/autoload.php';
use App\Config\Database;

header('Content-Type: application/json');

$status = [
    'status' => 'UP',
    'timestamp' => date('Y-m-d H:i:s'),
    'checks' => [],
    'info' => [
        'php_version' => phpversion(),
        'server' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'
    ]
];

// =========================================
// CHECK 1: Conexión a Base de Datos
// =========================================
try {
    $db = Database::getInstance()->getConnection();
    
    // Verificar que podemos hacer una query simple
    $result = $db->query("SELECT 1");
    
    if ($result) {
        $status['checks']['database'] = [
            'status' => 'OK',
            'message' => 'Conexión exitosa'
        ];
    } else {
        throw new Exception("No se pudo ejecutar query de prueba");
    }
    
} catch (Exception $e) {
    $status['status'] = 'DOWN';
    $status['checks']['database'] = [
        'status' => 'FAIL',
        'message' => $e->getMessage()
    ];
}

// =========================================
// CHECK 2: Espacio en Disco
// =========================================
$drive = "C:";
$freeSpace = @disk_free_space($drive);
$totalSpace = @disk_total_space($drive);

if ($freeSpace !== false && $totalSpace !== false) {
    $percentFree = ($freeSpace / $totalSpace) * 100;
    $freeSpaceGB = round($freeSpace / 1024 / 1024 / 1024, 2);
    
    if ($percentFree > 10) {
        $status['checks']['disk_space'] = [
            'status' => 'OK',
            'message' => "{$freeSpaceGB} GB libres (" . round($percentFree, 1) . "% libre)"
        ];
    } else {
        $status['status'] = 'WARNING';
        $status['checks']['disk_space'] = [
            'status' => 'WARNING',
            'message' => "Espacio bajo: {$freeSpaceGB} GB libres (" . round($percentFree, 1) . "% libre)"
        ];
    }
} else {
    $status['checks']['disk_space'] = [
        'status' => 'UNKNOWN',
        'message' => 'No se pudo determinar espacio en disco'
    ];
}

// =========================================
// CHECK 3: Directorio de Backups
// =========================================
$backupDir = __DIR__ . '/../backups';

if (is_dir($backupDir)) {
    $files = glob($backupDir . '/*.sql');
    $fileCount = count($files);
    
    if ($fileCount > 0) {
        // Obtener el backup más reciente
        $latestBackup = max(array_map('filemtime', $files));
        $hoursAgo = round((time() - $latestBackup) / 3600, 1);
        
        if ($hoursAgo < 48) {
            $status['checks']['backups'] = [
                'status' => 'OK',
                'message' => "Último backup hace {$hoursAgo} horas",
                'total_backups' => $fileCount
            ];
        } else {
            $status['status'] = 'WARNING';
            $status['checks']['backups'] = [
                'status' => 'WARNING',
                'message' => "Último backup hace {$hoursAgo} horas (antiguo)",
                'total_backups' => $fileCount
            ];
        }
    } else {
        $status['status'] = 'WARNING';
        $status['checks']['backups'] = [
            'status' => 'WARNING',
            'message' => 'No se encontraron backups'
        ];
    }
} else {
    $status['checks']['backups'] = [
        'status' => 'INFO',
        'message' => 'Directorio de backups no existe'
    ];
}

// =========================================
// CHECK 4: Tabla de Logs
// =========================================
if (isset($status['checks']['database']) && $status['checks']['database']['status'] === 'OK') {
    try {
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM logs WHERE nivel = 'ERROR' AND fecha > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        $errorCount = $result['total'];
        
        if ($errorCount < 5) {
            $status['checks']['logs'] = [
                'status' => 'OK',
                'message' => "{$errorCount} errores en la última hora"
            ];
        } else {
            $status['status'] = 'WARNING';
            $status['checks']['logs'] = [
                'status' => 'WARNING',
                'message' => "{$errorCount} errores en la última hora (elevado)"
            ];
        }
        
    } catch (Exception $e) {
        $status['checks']['logs'] = [
            'status' => 'INFO',
            'message' => 'No se pudo verificar logs: ' . $e->getMessage()
        ];
    }
}

// =========================================
// CHECK 5: Permisos de Escritura
// =========================================
$testFile = __DIR__ . '/../backups/.write_test';
$canWrite = @file_put_contents($testFile, 'test');

if ($canWrite !== false) {
    @unlink($testFile);
    $status['checks']['file_permissions'] = [
        'status' => 'OK',
        'message' => 'Permisos de escritura correctos'
    ];
} else {
    $status['status'] = 'WARNING';
    $status['checks']['file_permissions'] = [
        'status' => 'WARNING',
        'message' => 'No se puede escribir en directorio backups'
    ];
}

// =========================================
// RESPUESTA FINAL
// =========================================
http_response_code($status['status'] === 'UP' ? 200 : ($status['status'] === 'WARNING' ? 200 : 503));

echo json_encode($status, JSON_PRETTY_PRINT);
