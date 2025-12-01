<?php
namespace App\Controllers;

use App\Models\SalesDAO;

class ExportController {
    private $salesDAO;

    public function __construct() {
        $this->salesDAO = new SalesDAO();
    }

    public function exportHistory() {
        // Check authentication
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?route=login");
            exit();
        }

        $filters = [];
        $filename = "historial_ventas_" . date('Y-m-d') . ".csv";

        // Apply filters based on role
        if ($_SESSION['rol'] === 'admin') {
            // Admin can filter by everything
            if (!empty($_GET['start_date'])) $filters['start_date'] = $_GET['start_date'];
            if (!empty($_GET['end_date'])) $filters['end_date'] = $_GET['end_date'];
            if (!empty($_GET['role'])) $filters['role'] = $_GET['role'];
            if (!empty($_GET['user_id'])) $filters['user_id'] = $_GET['user_id'];
        } else {
            // Vendors and Clients can only see their own history (or sales related to them?)
            // Requirement says: 
            // Vendor: "historial de vendedor se pueda descargar en excel, con filtro de fechas"
            // Client: "en cliente, de igual forma"
            // Usually Client sees their OWN purchases. 
            // Vendor usually sees sales they made? Or if they are just a seller user, maybe they see all sales?
            // Based on previous code `vendedor/historial_ventas.php` query was `SELECT v.*, u.nombre AS vendedor FROM ventas v JOIN usuarios u ...`
            // It seems Vendor sees ALL sales? Or sales where they are the 'vendedor'?
            // Wait, the previous query in `vendedor/historial_ventas.php` was:
            // `SELECT v.*, u.nombre AS vendedor FROM ventas v JOIN usuarios u ON v.id_usuario = u.id ...`
            // `id_usuario` in `ventas` usually refers to the CUSTOMER who bought it.
            // If the system tracks who SOLD it, there should be another column.
            // Let's look at `ventas` table structure implied by `SalesDAO::createSale`: `INSERT INTO ventas (id_usuario, total, fecha) ...`
            // It only tracks `id_usuario` (the buyer).
            // So "Vendor History" might mean "Sales made by the store" (visible to vendor)?
            // Or if `id_usuario` is the one logged in, then for Client it is their purchases.
            // For Vendor, if they are just viewing sales, maybe they see ALL sales?
            // The user request says: "historial de vendedor se pueda descargar... en cliente de igual forma".
            // Let's assume:
            // Client -> Filter by THEIR user_id.
            // Vendor -> Can see ALL sales (like a manager) or maybe just theirs if they were the seller?
            // Given the schema only has `id_usuario`, I will assume `id_usuario` is the BUYER.
            // So Vendor likely wants to see ALL sales (store history).
            
            // Vendors and Clients can only see their own history
            if ($_SESSION['rol'] === 'cliente' || $_SESSION['rol'] === 'vendedor') {
                $filters['user_id'] = $_SESSION['usuario_id'];
            }
            
            if (!empty($_GET['start_date'])) $filters['start_date'] = $_GET['start_date'];
            if (!empty($_GET['end_date'])) $filters['end_date'] = $_GET['end_date'];
        }

        $data = $this->salesDAO->getSalesHistory($filters);

        // Set headers for CSV download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // CSV Headers
        fputcsv($output, ['ID Venta', 'Fecha', 'Usuario/Cliente', 'Rol', 'Total (S/)']);

        // Data
        if ($data && $data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                fputcsv($output, [
                    $row['id'],
                    $row['fecha'],
                    $row['usuario_nombre'] . ' (' . $row['usuario'] . ')',
                    $row['rol'],
                    number_format($row['total'], 2)
                ]);
            }
        }

        fclose($output);
        exit();
    }
}
