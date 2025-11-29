<?php
namespace App\Models;

use App\Config\Database;

class Logger {
    private static $instance = null;
    private $db;

    private function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    /**
     * Método principal para registrar eventos
     * 
     * @param string $tipo_evento Tipo de evento (login, logout, venta, etc.)
     * @param string $descripcion Descripción del evento
     * @param string $nivel Nivel del log (info, warning, error)
     * @param int|null $id_usuario ID del usuario (null para eventos del sistema)
     * @return bool
     */
    public function log($tipo_evento, $descripcion, $nivel = 'info', $id_usuario = null) {
        try {
            // Obtener IP del cliente
            $ip_address = $this->getClientIP();
            
            // Obtener User-Agent
            $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? 
                substr($_SERVER['HTTP_USER_AGENT'], 0, 255) : 'Unknown';

            // Si no se proporciona id_usuario, intentar obtenerlo de la sesión
            if ($id_usuario === null && isset($_SESSION['usuario_id'])) {
                $id_usuario = $_SESSION['usuario_id'];
            }

            $stmt = $this->db->prepare(
                "INSERT INTO logs (id_usuario, tipo_evento, descripcion, ip_address, user_agent, nivel) 
                 VALUES (?, ?, ?, ?, ?, ?)"
            );
            
            $stmt->bind_param("isssss", $id_usuario, $tipo_evento, $descripcion, $ip_address, $user_agent, $nivel);
            return $stmt->execute();
        } catch (\Exception $e) {
            // Si falla el logging, no queremos romper la aplicación
            error_log("Error al registrar log: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Registrar login exitoso o fallido
     */
    public function logLogin($id_usuario, $username, $success = true) {
        $nivel = $success ? 'info' : 'warning';
        $descripcion = $success ? 
            "Login exitoso para usuario: {$username}" : 
            "Intento de login fallido para usuario: {$username}";
        
        return $this->log('login', $descripcion, $nivel, $success ? $id_usuario : null);
    }

    /**
     * Registrar logout
     */
    public function logLogout($id_usuario, $username) {
        $descripcion = "Logout de usuario: {$username}";
        return $this->log('logout', $descripcion, 'info', $id_usuario);
    }

    /**
     * Registrar nuevo registro de usuario
     */
    public function logRegistro($username, $rol) {
        $descripcion = "Nuevo usuario registrado: {$username} con rol: {$rol}";
        return $this->log('registro', $descripcion, 'info');
    }

    /**
     * Registrar venta
     */
    public function logSale($id_usuario, $id_venta, $total) {
        $descripcion = "Venta registrada - ID: {$id_venta}, Total: S/ {$total}";
        return $this->log('venta', $descripcion, 'info', $id_usuario);
    }

    /**
     * Registrar modificación de carrito
     */
    public function logCarrito($id_usuario, $accion, $producto_nombre, $cantidad) {
        $descripcion = "Carrito - {$accion}: {$producto_nombre} (cantidad: {$cantidad})";
        return $this->log('carrito', $descripcion, 'info', $id_usuario);
    }

    /**
     * Registrar cambios en productos
     */
    public function logProducto($accion, $producto_nombre, $detalles = '') {
        $descripcion = "Producto - {$accion}: {$producto_nombre}";
        if ($detalles) {
            $descripcion .= " - {$detalles}";
        }
        return $this->log('producto', $descripcion, 'info');
    }

    /**
     * Registrar acciones de administración de usuarios
     */
    public function logUserAction($id_usuario_admin, $accion, $usuario_afectado, $detalles = '') {
        $descripcion = "Administración de usuarios - {$accion}: {$usuario_afectado}";
        if ($detalles) {
            $descripcion .= " - {$detalles}";
        }
        return $this->log('usuario', $descripcion, 'info', $id_usuario_admin);
    }

    /**
     * Registrar errores del sistema
     */
    public function logError($descripcion, $trace = null) {
        if ($trace) {
            $descripcion .= "\nStack trace: " . substr($trace, 0, 500);
        }
        return $this->log('error', $descripcion, 'error');
    }

    /**
     * Obtener la IP real del cliente
     */
    private function getClientIP() {
        $ip = 'Unknown';
        
        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Puede contener múltiples IPs, tomar la primera
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip = trim($ips[0]);
        } elseif (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        // Validar formato IPv4 o IPv6
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return substr($ip, 0, 45); // Limitar a 45 caracteres (tamaño máximo de IPv6)
        }
        
        return 'Unknown';
    }
}
