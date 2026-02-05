<?php
class ResponseHelper {

    public static function json($data, $status = 200) {
        http_response_code($status);
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }

    public static function error($message, $status = 400) {
        self::json(["erro" => $message], $status);
    }

    public static function success($message) {
        self::json(["msg" => $message]);
    }
}

?>