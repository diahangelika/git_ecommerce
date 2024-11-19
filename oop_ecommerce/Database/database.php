<?php
require_once(__DIR__ . '/../Config/init.php');

class Database
{
    private $host;
    private $database;
    private $username;
    private $password;
    private static $conn;

    public function __construct()
    {
        $this->host = DB_SERVER;
        $this->database = DB_DATABASE;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
    }

    public function getInstance()
    {
        if (!isset(self::$conn)) {
            self::$conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }
        return self::$conn;
    }

    public function selectData(
        string $tableName,
        array $columns = ['*'],
        array $joins = [],
        array $where = [],
        int $limit = 0
      ) {
        try {
          $columnList = implode(", ", $columns);
    
          $query = "SELECT $columnList FROM $tableName";

          if (count($joins) > 0) {
            foreach ($joins as $joinTable => $onCondition) {
              $query .= " INNER JOIN $joinTable ON $onCondition";
            }
          }
    
          if (count($where) > 0) {
            $conditions = [];
            foreach ($where as $key => $value) {
              $conditions[] = "$key = :$key";
            }
            $query .= " WHERE " . implode(" AND ", $conditions);
          }
    
          if ($limit > 0) {
            $query .= " LIMIT $limit";
          }

          // var_dump($query);
    
          $field = $this->getInstance()->prepare($query);
    
          foreach ($where as $key => &$value) {
            $field->bindParam(":$key", $value);
          }
    
          $field->execute();
    
          return $field->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
          return false;
        }
      }


    public function insertData($tableName, $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->getInstance()->prepare($query);
        return $stmt->execute($data);
    }

    public function updateData($tableName, $id, $data)
    {
        $sets = [];
        foreach ($data as $key => $value) {
            $sets[] = "$key = :$key";
        }
        $query = "UPDATE {$tableName} SET " . implode(', ', $sets) . " WHERE id = :id";
        $stmt = $this->getInstance()->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function deleteRecord($tableName, $id)
    {
        $query = "UPDATE {$tableName} SET isDeleted=1 WHERE id=($id)";
        $stmt = $this->getInstance()->prepare($query);
        $stmt->execute();
    }

    public function restoreRecord($tableName)
    {
        $query = "UPDATE {$tableName} SET isDeleted=0 WHERE isDeleted=1";
        $stmt = $this->getInstance()->prepare($query);
        return $stmt->execute();
    }
}
