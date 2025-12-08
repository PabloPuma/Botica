<?php
namespace App\Controllers;

use App\Models\UserDAO;
use App\Models\Logger;

class ProfileController {
    public $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $user = $this->userDAO->getUserById($_SESSION['usuario_id']);
        
        // Cargar vista según el rol
        $rol = $_SESSION['rol'];
        require __DIR__ . "/../Views/{$rol}/perfil.php";
    }

    public function update($data) {
        if (!isset($_SESSION['usuario_id'])) {
            return "Debe iniciar sesión.";
        }

        $userId = $_SESSION['usuario_id'];
        $nombre = $data['nombre'] ?? '';
        $correo = $data['correo'] ?? '';
        $telefono = $data['telefono'] ?? '';
        $direccion = $data['direccion'] ?? '';
        $nuevoUsuario = $data['usuario'] ?? null;

        // Obtener datos actuales del usuario
        $currentUser = $this->userDAO->getUserById($userId);

        // Si se envió un nuevo usuario y el usuario actual == DNI, permitir cambio
        if ($nuevoUsuario && $currentUser['usuario'] === $currentUser['dni'] && $nuevoUsuario !== $currentUser['usuario']) {
            if (!$this->userDAO->updateUsername($userId, $nuevoUsuario)) {
                return "El nombre de usuario ya está en uso.";
            }
            // Actualizar session
            $_SESSION['usuario'] = $nuevoUsuario;
        }

        if ($this->userDAO->updateProfile($userId, $nombre, $correo, $telefono, $direccion)) {
            // Log profile update
            Logger::getInstance()->logUserAction(
                $userId,
                'Actualizar perfil',
                'Perfil actualizado'
            );
            return true;
        }
        return "Error al actualizar perfil.";
    }

    public function changePassword($currentPassword, $newPassword) {
        if (!isset($_SESSION['usuario_id'])) {
            return "Debe iniciar sesión.";
        }

        $userId = $_SESSION['usuario_id'];

        // Verificar contraseña actual
        if (!$this->userDAO->verifyPassword($userId, $currentPassword)) {
            return "La contraseña actual es incorrecta.";
        }

        if ($this->userDAO->updatePassword($userId, $newPassword)) {
            // Log password change
            Logger::getInstance()->logUserAction(
                $userId,
                'Cambiar contraseña',
                'Contraseña actualizada'
            );
            return true;
        }
        return "Error al cambiar contraseña.";
    }
}
