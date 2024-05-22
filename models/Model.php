<?php

namespace models;

use core\App;
use core\Session;
use core\Database;

class Model {

    protected $table;
    protected $db;

    public function __construct() {

        $this->db = App::resolve(Database::class);
    }

    public function all() {

        $currentUserID = Session::user('id');
        $result = $this->db->query("select * from {$this->table} where user_id = :user_id", [
            ':user_id' => $currentUserID
        ])->get();
        return $result;
    }

    public function find($id) {

        $result = $this->db->query("select * from {$this->table} where id = :id", [
            ':id' => $id
        ])->find();
        return $result;
    }

    public function findOrFail($id) {

        $result = $this->db->query("select * from {$this->table} where id = :id", [
            ':id' => $id
        ])->findOrFail();
        return $result;
    }

    public function where($column, $operator, $value) {

        $this->db->query("select * from {$this->table} where {$column} {$operator} :{$column}", [
            ":{$column}" => $value
        ]);
        return $this->db;
    }

    public function create($data) {

        $columns = array_keys($data);
        $fields = implode(', ', $columns);
        $values = ':'.implode(', :', $columns);
        $this->db->query("insert into {$this->table}({$fields}) values({$values})", $data);
        return $this;
    }

    public function update($id, $data) {

        $setColumnsForm = [];
        foreach($data as $key => $value) {
            $setColumnsForm[] = "{$key} = :{$key}";
        }
        $setColumnsForm = implode(', ', $setColumnsForm);
        $data['id'] = $id;
        $this->db->query("update {$this->table} set {$setColumnsForm} where id = :id", $data);
        return $this;
    }

    public function destroy($id) {

        $this->db->query("delete from {$this->table} where id = :id", [
            'id' => $id
        ]);
        return $this;
    }
}