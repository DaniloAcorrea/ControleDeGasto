<?php
class ValidationHelper {

    public static function required($data, $fields) {
        foreach ($fields as $field) {
            if (!isset($data[$field]) || trim($data[$field]) === "") {
                return false;
            }
        }
        return true;
    }

    public static function email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function number($value) {
        return is_numeric($value);
    }
}
