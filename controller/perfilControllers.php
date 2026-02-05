<?php
require_once "../config/database.php";

class PerfilController {

    public static function register() {
        $db = Database::connect();
        $data = json_decode(file_get_contents("php://input"), true);

        $senhaHash = password_hash($data['senha'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO perfil (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$data['nome'], $data['email'], $senhaHash]);

        echo json_encode(["msg" => "Perfil criado"]);
    }

    public static function login() {
        $db = Database::connect();
        $data = json_decode(file_get_contents("php://input"), true);

        $sql = "SELECT * FROM perfil WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$data['email']]);

        $perfil = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($perfil && password_verify($data['senha'], $perfil['senha'])) {
            echo json_encode([
                "id" => $perfil['id_perfil'],
                "nome" => $perfil['nome'],
                "email" => $perfil['email']
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["erro" => "Login inválido"]);
        }
    }
}

?>