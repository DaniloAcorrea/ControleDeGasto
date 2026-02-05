<?php
require_once "../config/database.php";

class CategoriaController {

    public static function create() {
        $db = Database::connect();
        $data = json_decode(file_get_contents("php://input"), true);

        $sql = "INSERT INTO categoria (nome, tipo) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$data['nome'], $data['tipo']]);

        echo json_encode(["msg" => "Categoria criada"]);
    }

    public static function list() {
        $db = Database::connect();

        $stmt = $db->query("SELECT * FROM categoria");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}

?>