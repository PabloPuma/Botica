<?php
namespace App\Controllers;

use App\Models\UserDAO;
use App\Models\Logger;

class AuthController {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function login($username, $password) {
        $user = $this->userDAO->findByUsername($username);

        if ($user && password_verify($password, $user['clave'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['rol'] = $user['rol'];
            
            // Log successful login
            Logger::getInstance()->logLogin($user['id'], $username, true);
            
            return true;
        }
        
        // Log failed login attempt
        Logger::getInstance()->logLogin(null, $username, false);
        
        return false;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Log logout before clearing session
        if (isset($_SESSION['usuario_id']) && isset($_SESSION['nombre'])) {
            Logger::getInstance()->logLogout($_SESSION['usuario_id'], $_SESSION['nombre']);
        }
        
        // Clear cart for admin and vendedor roles before destroying session
        if (isset($_SESSION['rol']) && isset($_SESSION['usuario_id'])) {
            if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'vendedor') {
                require_once __DIR__ . '/../Models/SalesDAO.php';
                $salesDAO = new \App\Models\SalesDAO();
                $salesDAO->clearCart($_SESSION['usuario_id']);
            }
        }
        
        session_destroy();
        header("Location: index.php?route=login");
        exit();
    }

    public function register($nombre, $usuario, $clave, $rol = 'cliente') {
        // Basic validation
        if (empty($nombre) || empty($usuario) || empty($clave)) {
            return "Todos los campos son obligatorios.";
        }
        
        // Check if user exists (should add method to DAO for this, but for now relying on DB constraint or simple check)
        // Ideally: if ($this->userDAO->findByUsername($usuario)) return "Usuario ya existe";

        if ($this->userDAO->create($nombre, $usuario, $clave, $rol)) {
            // Log successful registration
            Logger::getInstance()->logRegistro($usuario, $rol);
            return true;
        }
        return "Error al registrar usuario.";
    }
    
    public function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../Login Page.php");
            exit();
        }
    }
    
    public function requireRole($role) {
        $this->checkAuth();
        if ($_SESSION['rol'] !== $role) {
            die("Acceso denegado.");
        }
    }
}
