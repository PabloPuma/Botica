<?php
namespace App\Models;

use App\Config\Database;

class UserDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT id, nombre, clave, rol FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create($nombre, $usuario, $clave, $rol, $dni = null) {
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, usuario, clave, rol, dni) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $usuario, $hash, $rol, $dni);
        return $stmt->execute();
    }

    public function findByDNI($dni) {
        $stmt = $this->db->prepare("SELECT id, nombre, dni, usuario, clave, rol, correo, telefono, direccion FROM usuarios WHERE dni = ?");
        $stmt->bind_param("s", $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare("SELECT id, nombre, dni, usuario, rol, correo, telefono, direccion, edad, genero FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateProfile($userId, $nombre, $correo, $telefono, $direccion) {
        $stmt = $this->db->prepare("UPDATE usuarios SET nombre = ?, correo = ?, telefono = ?, direccion = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nombre, $correo, $telefono, $direccion, $userId);
        return $stmt->execute();
    }

    public function updatePassword($userId, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE usuarios SET clave = ? WHERE id = ?");
        $stmt->bind_param("si", $hash, $userId);
        return $stmt->execute();
    }

    public function verifyPassword($userId, $password) {
        $stmt = $this->db->prepare("SELECT clave FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user) {
            return password_verify($password, $user['clave']);
        }
        return false;
    }

    public function updateUsername($userId, $newUsername) {
        // Verificar que el username no esté en uso
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE usuario = ? AND id != ?");
        $stmt->bind_param("si", $newUsername, $userId);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            return false; // Username ya existe
        }
        
        // Actualizar username
        $stmt = $this->db->prepare("UPDATE usuarios SET usuario = ? WHERE id = ?");
        $stmt->bind_param("si", $newUsername, $userId);
        return $stmt->execute();
    }
}
