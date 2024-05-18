<?php

namespace core;

class Validator {

    public static function required($value) {

        $value = trim($value);
        return strlen($value) !== 0;
    }

    public static function string($value, $min = 1, $max = INF) {
        
        $value = trim($value);
        return $min <= strlen($value) && strlen($value) <= $max;
    }

    public static function email($value) {

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function password_match($pwd_1, $pwd_2) {

        return $pwd_1 === $pwd_2;
    }

    public static function unique($table, $column, $value) {

        $db = App::resolve(Database::class);

        $result = $db->query("select * from {$table} where {$column} = :value", [
            ':value' => $value
        ])->find();

        if($result) {
           return false; 
        }

        return true;
    }
}