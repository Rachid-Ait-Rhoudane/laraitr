<?php

namespace core;
use PDO;

class Database {

    private static $db = null;
    private $connection;
    private $statement;

    private function __construct($config, $username = 'root', $password = '') {

        $dsn = 'mysql:'.http_build_query(data: $config, arg_separator: ';');
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public static function create($config, $username = 'root', $password = '') {

        if(static::$db) {

            return static::$db;
        }

        static::$db = new static($config, $username = 'root', $password = '');

        return static::$db;
    }

    public function query($query, $params = []) {

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function find() {

        return $this->statement->fetch();
    }

    public function findOrFail() {

        $result = $this->statement->fetch();
        if(!$result) {
            abort();
        }
        return $result;
    }

    public function get() {

        return $this->statement->fetchAll();
    }
}