<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\UserDAO;
use App\Models\Logger;

class AdminController {
    private $db;
    private $userDAO;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->userDAO = new UserDAO();
    }

    public function index() {
        // Dashboard stats (similar to Vendor but maybe more global)
        // For now, reuse the logic in the view or fetch here
    }

    public function getAllUsers() {
        $result = $this->db->query("SELECT id, nombre, dni, usuario, rol, activo FROM usuarios");
        return $result;
    }

    public function createUser($data) {
        $nombre = $data['nombre'];
        $dni = $data['dni'] ?? null;
        $usuario = $data['usuario'];
        $clave = $data['clave'];
        $rol = $data['rol'];

        if ($this->userDAO->findByUsername($usuario)) {
            return "El usuario ya existe.";
        }

        // Validar DNI único
        if ($dni && $this->userDAO->findByDNI($dni)) {
            return "El DNI ya está registrado.";
        }

        if ($this->userDAO->create($nombre, $usuario, $clave, $rol, $dni)) {
            // Log user creation
            if (isset($_SESSION['usuario_id'])) {
                Logger::getInstance()->logUserAction(
                    $_SESSION['usuario_id'], 
                    'Crear usuario', 
                    $usuario, 
                    "Rol: {$rol}"
                );
            }
            return true;
        }
        return "Error al crear usuario.";
    }

    public function deleteUser($id) {
        // Prevent deleting self
        if ($id == $_SESSION['usuario_id']) {
            return "No puedes eliminar tu propia cuenta.";
        }

        // Check if user has sales
        if ($this->userDAO->hasSales($id)) {
            return "No se puede eliminar este usuario porque tiene ventas registradas.";
        }
        
        // Get user info before deletion for logging
        $stmt_info = $this->db->prepare("SELECT usuario FROM usuarios WHERE id = ?");
        $stmt_info->bind_param("i", $id);
        $stmt_info->execute();
        $result = $stmt_info->get_result();
        $user_info = $result->fetch_assoc();
        
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Log user deletion
            if (isset($_SESSION['usuario_id']) && $user_info) {
                Logger::getInstance()->logUserAction(
                    $_SESSION['usuario_id'], 
                    'Eliminar usuario', 
                    $user_info['usuario']
                );
            }
            return true;
        }
        return "Error al eliminar usuario.";
    }

    public function editUser($id, $data) {
        $nombre = $data['nombre'] ?? '';
        $correo = $data['correo'] ?? '';
        $telefono = $data['telefono'] ?? '';
        $rol = $data['rol'] ?? '';

        if ($this->userDAO->updateUserData($id, $nombre, $correo, $telefono, $rol)) {
            // Log user edit
            Logger::getInstance()->logUserAction(
                $_SESSION['usuario_id'], 
                'Editar usuario', 
                "ID: {$id}"
            );
            return true;
        }
        return "Error al actualizar usuario.";
    }

    public function activateUser($id) {
        if ($this->userDAO->activateUser($id)) {
            Logger::getInstance()->logUserAction(
                $_SESSION['usuario_id'], 
                'Activar usuario', 
                "ID: {$id}"
            );
            return true;
        }
        return "Error al activar usuario.";
    }

    public function deactivateUser($id) {
        if ($this->userDAO->deactivateUser($id)) {
            Logger::getInstance()->logUserAction(
                $_SESSION['usuario_id'], 
                'Desactivar usuario', 
                "ID: {$id}"
            );
            return true;
        }
        return "Error al desactivar usuario.";
    }
}
