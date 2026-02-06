<?php
require_once "../config/database.php";

class TransacaoController {

    public static function create() {
        $db = Database::connect();
        $data = json_decode(file_get_contents("php://input"), true);

        $sql = "INSERT INTO transacao 
        (nome, valor, data_transacao, categoria_id, perfil_id)
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            $data['nome'],
            $data['valor'],
            $data['data'],
            $data['categoria_id'],
            $data['perfil_id']
        ]);

        echo json_encode(["msg" => "Transação criada"]);
    }

    public static function listByPerfil() {
        $db = Database::connect();
        $perfil_id = $_GET['perfil_id'];

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

        $stmt = $db->prepare($sql);
        $stmt->execute([$perfil_id]);

        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public static function saldo() {
        $db = Database::connect();
        $perfil_id = $_GET['perfil_id'];

        $sql = "
        SELECT 
            SUM(CASE WHEN c.tipo = 'ganho' THEN t.valor ELSE 0 END) AS ganhos,
            SUM(CASE WHEN c.tipo = 'gasto' THEN t.valor ELSE 0 END) AS gastos
        FROM transacao t
        JOIN categoria c ON c.id_categoria = t.categoria_id
        WHERE t.perfil_id = ?
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute([$perfil_id]);

        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }
}
