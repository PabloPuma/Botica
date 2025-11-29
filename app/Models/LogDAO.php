<?php
namespace App\Models;

use App\Config\Database;

class LogDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Obtener todos los logs con paginación
     */
    public function getAllLogs($limit = 50, $offset = 0) {
        $stmt = $this->db->prepare(
            "SELECT l.*, u.nombre as usuario_nombre, u.rol as usuario_rol 
             FROM logs l 
             LEFT JOIN usuarios u ON l.id_usuario = u.id 
             ORDER BY l.fecha DESC 
             LIMIT ? OFFSET ?"
        );
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Obtener logs de un usuario específico
     */
    public function getLogsByUser($id_usuario, $limit = 100) {
        $stmt = $this->db->prepare(
            "SELECT l.*, u.nombre as usuario_nombre, u.rol as usuario_rol 
             FROM logs l 
             LEFT JOIN usuarios u ON l.id_usuario = u.id 
             WHERE l.id_usuario = ? 
             ORDER BY l.fecha DESC 
             LIMIT ?"
        );
        $stmt->bind_param("ii", $id_usuario, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Obtener logs por tipo de evento
     */
    public function getLogsByType($tipo_evento, $limit = 100) {
        $stmt = $this->db->prepare(
            "SELECT l.*, u.nombre as usuario_nombre, u.rol as usuario_rol 
             FROM logs l 
             LEFT JOIN usuarios u ON l.id_usuario = u.id 
             WHERE l.tipo_evento = ? 
             ORDER BY l.fecha DESC 
             LIMIT ?"
        );
        $stmt->bind_param("si", $tipo_evento, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Obtener logs filtrados por rol de usuario
     */
    public function getLogsByRole($rol, $limit = 100) {
        $stmt = $this->db->prepare(
            "SELECT l.*, u.nombre as usuario_nombre, u.rol as usuario_rol 
             FROM logs l 
             INNER JOIN usuarios u ON l.id_usuario = u.id 
             WHERE u.rol = ? 
             ORDER BY l.fecha DESC 
             LIMIT ?"
        );
        $stmt->bind_param("si", $rol, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Obtener logs por nivel
     */
    public function getLogsByLevel($nivel, $limit = 100) {
        $stmt = $this->db->prepare(
            "SELECT l.*, u.nombre as usuario_nombre, u.rol as usuario_rol 
             FROM logs l 
             LEFT JOIN usuarios u ON l.id_usuario = u.id 
             WHERE l.nivel = ? 
             ORDER BY l.fecha DESC 
             LIMIT ?"
        );
        $stmt->bind_param("si", $nivel, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Obtener logs en un rango de fechas
     */
    public function getLogsByDateRange($fecha_inicio, $fecha_fin, $limit = 100) {
        $stmt = $this->db->prepare(
            "SELECT l.*, u.nombre as usuario_nombre, u.rol as usuario_rol 
             FROM logs l 
             LEFT JOIN usuarios u ON l.id_usuario = u.id 
             WHERE l.fecha BETWEEN ? AND ? 
             ORDER BY l.fecha DESC 
             LIMIT ?"
        );
        $stmt->bind_param("ssi", $fecha_inicio, $fecha_fin, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Búsqueda en descripción de logs
     */
    public function searchLogs($search_term, $limit = 100) {
        $search_pattern = "%{$search_term}%";
        $stmt = $this->db->prepare(
            "SELECT l.*, u.nombre as usuario_nombre, u.rol as usuario_rol 
             FROM logs l 
             LEFT JOIN usuarios u ON l.id_usuario = u.id 
             WHERE l.descripcion LIKE ? 
             ORDER BY l.fecha DESC 
             LIMIT ?"
        );
        $stmt->bind_param("si", $search_pattern, $limit);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Obtener logs con filtros combinados
     */
    public function getLogsWithFilters($filters = [], $limit = 50, $offset = 0) {
        $where_clauses = [];
        $params = [];
        $types = "";

        // Construir cláusulas WHERE dinámicamente
        if (!empty($filters['tipo_evento'])) {
            $where_clauses[] = "l.tipo_evento = ?";
            $params[] = $filters['tipo_evento'];
            $types .= "s";
        }

        if (!empty($filters['rol'])) {
            $where_clauses[] = "u.rol = ?";
            $params[] = $filters['rol'];
            $types .= "s";
        }

        if (!empty($filters['nivel'])) {
            $where_clauses[] = "l.nivel = ?";
            $params[] = $filters['nivel'];
            $types .= "s";
        }

        if (!empty($filters['search'])) {
            $where_clauses[] = "l.descripcion LIKE ?";
            $params[] = "%{$filters['search']}%";
            $types .= "s";
        }

        if (!empty($filters['fecha_inicio']) && !empty($filters['fecha_fin'])) {
            $where_clauses[] = "l.fecha BETWEEN ? AND ?";
            $params[] = $filters['fecha_inicio'];
            $params[] = $filters['fecha_fin'];
            $types .= "ss";
        }

        // Construir query
        $query = "SELECT l.*, u.nombre as usuario_nombre, u.rol as usuario_rol 
                  FROM logs l 
                  LEFT JOIN usuarios u ON l.id_usuario = u.id";

        if (!empty($where_clauses)) {
            $query .= " WHERE " . implode(" AND ", $where_clauses);
        }

        $query .= " ORDER BY l.fecha DESC LIMIT ? OFFSET ?";

        // Añadir limit y offset a params
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";

        $stmt = $this->db->prepare($query);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Obtener total de logs (para paginación)
     */
    public function getTotalCount($filters = []) {
        $where_clauses = [];
        $params = [];
        $types = "";

        // Aplicar los mismos filtros que en getLogsWithFilters
        if (!empty($filters['tipo_evento'])) {
            $where_clauses[] = "l.tipo_evento = ?";
            $params[] = $filters['tipo_evento'];
            $types .= "s";
        }

        if (!empty($filters['rol'])) {
            $where_clauses[] = "u.rol = ?";
            $params[] = $filters['rol'];
            $types .= "s";
        }

        if (!empty($filters['nivel'])) {
            $where_clauses[] = "l.nivel = ?";
            $params[] = $filters['nivel'];
            $types .= "s";
        }

        if (!empty($filters['search'])) {
            $where_clauses[] = "l.descripcion LIKE ?";
            $params[] = "%{$filters['search']}%";
            $types .= "s";
        }

        if (!empty($filters['fecha_inicio']) && !empty($filters['fecha_fin'])) {
            $where_clauses[] = "l.fecha BETWEEN ? AND ?";
            $params[] = $filters['fecha_inicio'];
            $params[] = $filters['fecha_fin'];
            $types .= "ss";
        }

        $query = "SELECT COUNT(*) as total 
                  FROM logs l 
                  LEFT JOIN usuarios u ON l.id_usuario = u.id";

        if (!empty($where_clauses)) {
            $query .= " WHERE " . implode(" AND ", $where_clauses);
        }

        $stmt = $this->db->prepare($query);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
