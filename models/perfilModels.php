<?php
require_once "../config/database.php";

class Perfil {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function criar($nome, $email, $senha) {
        $sql = "INSERT INTO perfil (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $email, $senha]);
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM perfil WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT id_perfil, nome, email FROM perfil WHERE id_perfil = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
