<?php

require_once 'config/database.php';

class AppModel {

    public static function all()
    {
        $table = strtolower(static::class) . 's';
        $conn = Database::connect();

        $stmt = $conn->prepare("SELECT * FROM {$table}"); 
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $stmt->fetchAll();

        $conn = null;
        return $result;
    }

    public static function find($id)
    {
        $table = strtolower(static::class) . 's';
        $conn = Database::connect();

        $stmt = $conn->prepare("SELECT * FROM {$table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        $conn = null;

        $class = static::class;
        $obj = new $class();
        foreach ($result as $key => $value) {
            $obj->$key = $value;
        }

        return $obj;
    }

    public static function create(array $request)
    {
        $table = strtolower(static::class) . 's';
        $conn = Database::connect();
        
        $stmt = $conn->prepare("SHOW COLUMNS FROM {$table}");
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $columns = array_combine($columns, $columns);

        $request = array_intersect_key($request, $columns);
        $keys = array_keys($request);
        $fieldsQuery = $valuesQuery = '';

        foreach ($request as $key => $value) {
            $fieldsQuery .= "{$key}, ";
            $valuesQuery .= ":{$key}, ";
        }
        $fieldsQuery = rtrim($fieldsQuery, ', ');
        $valuesQuery = rtrim($valuesQuery, ', ');

        $stmt = $conn->prepare("INSERT INTO {$table} ({$fieldsQuery}) VALUES ({$valuesQuery})");
        foreach ($request as $key => $value) {
            $stmt->bindParam(":{$key}", $value);
        }
        $stmt->execute();

        // tìm và trả về kết quả cuối cùng
        $lastId = $conn->lastInsertId();
        $stmt = $conn->prepare("SELECT * FROM {$table} WHERE id = :id");
        $stmt->execute([':id' => $lastId]);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        $conn = null;
        return $result;
    }

    public function update(array $request)
    {
        $table = strtolower(static::class) . 's';
        $conn = Database::connect();

        $valueUpdate = '';
        foreach ($request as $key => $value) {
            $valueUpdate .= "{$key} = :{$key}, ";
        }
        $valueUpdate = rtrim($valueUpdate, ', ');

        $stmt = $conn->prepare("UPDATE {$table} SET {$valueUpdate} WHERE id = :id");
        foreach ($request as $key => $value) {
            $stmt->bindParam(":{$key}", $value);
        }
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $isUpdate = $stmt->rowCount() && true;

        $conn = null;
        return $isUpdate;
    }
}
