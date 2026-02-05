<?php
require_once "../config/db.php";

class Categoria {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function criar($nome, $tipo) {
        $sql = "INSERT INTO categoria (nome, tipo) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nome, $tipo]);
    }

    public function listar() {
        $sql = "SELECT * FROM categoria";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
