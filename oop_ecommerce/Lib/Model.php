<?php
require_once(__DIR__ . '/../Config/init.php');

class Model
{
    protected $db;
    protected $tableName;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    // public function getAll($joins = [])
    // {
    //     return $this->db->selectData($this->tableName, ['p.id', 'p.product_name', 'p.harga', 'c.kategori'], $joins);
    // }
    

    // public function getById($id)
    // {
    //     return $this->db->selectData($this->tableName, $id);
    // }

    public function create($data)
    {
        return $this->db->insertData($this->tableName, $data);
    }

    public function update($id, $data)
    {
        return $this->db->updateData($this->tableName, $id, $data);
    }

    // public function delete($id)
    // {
    //     return $this->db->deleteRecord($this->tableName, $id);
    // }

    public function restore()
    {
        $this->db->restoreRecord($this->tableName);
    }
}
