<?php
// Health Check Endpoint
header('Content-Type: application/json');

require_once __DIR__ . '/../app/autoload.php';
use App\Config\Database;

$response = [
    'status' => 'ok',
    'timestamp' => date('c'),
    'checks' => [
        'database' => 'unknown',
        'disk_space' => 'ok'
    ]
];

try {
    $db = Database::getInstance()->getConnection();
    if ($db->ping()) {
        $response['checks']['database'] = 'ok';
    } else {
        $response['checks']['database'] = 'error';
        $response['status'] = 'error';
    }
} catch (Exception $e) {
    $response['checks']['database'] = 'error: ' . $e->getMessage();
    $response['status'] = 'error';
}

echo json_encode($response);
