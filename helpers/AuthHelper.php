<?php
class AuthHelper {

    public static function hashSenha($senha) {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public static function verificarSenha($senha, $hash) {
        return password_verify($senha, $hash);
    }
}
