<?php
require_once "../config/db.php";

class Transacao {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function criar($nome, $valor, $data, $categoria_id, $perfil_id) {
        $sql = "INSERT INTO transacao 
        (nome, valor, data_transacao, categoria_id, perfil_id)
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $nome,
            $valor,
            $data,
            $categoria_id,
            $perfil_id
        ]);
    }

    public function listarPorPerfil($perfil_id) {
        $sql = "
        SELECT 
            t.nome,
            t.valor,
            t.data_transacao,
            c.nome AS categoria,
            c.tipo
        FROM transacao t
        JOIN categoria c ON c.id_categoria = t.categoria_id
        WHERE t.perfil_id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$perfil_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saldo($perfil_id) {
        $sql = "
        SELECT 
            SUM(CASE WHEN c.tipo = 'ganho' THEN t.valor ELSE 0 END) AS ganhos,
            SUM(CASE WHEN c.tipo = 'gasto' THEN t.valor ELSE 0 END) AS gastos
        FROM transacao t
        JOIN categoria c ON c.id_categoria = t.categoria_id
        WHERE t.perfil_id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$perfil_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
