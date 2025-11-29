<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\UserDAO;

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
        $result = $this->db->query("SELECT id, nombre, usuario, rol FROM usuarios");
        return $result;
    }

    public function createUser($data) {
        $nombre = $data['nombre'];
        $usuario = $data['usuario'];
        $clave = $data['clave'];
        $rol = $data['rol'];

        if ($this->userDAO->findByUsername($usuario)) {
            return "El usuario ya existe.";
        }

        if ($this->userDAO->create($nombre, $usuario, $clave, $rol)) {
            return true;
        }
        return "Error al crear usuario.";
    }

    public function deleteUser($id) {
        // Prevent deleting self
        if ($id == $_SESSION['usuario_id']) {
            return "No puedes eliminar tu propia cuenta.";
        }
        
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        }
        return "Error al eliminar usuario.";
    }
}
