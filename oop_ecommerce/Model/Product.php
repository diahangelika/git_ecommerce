<?php
require_once(__DIR__ . '/../Lib/Model.php');

class Product extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('products');
    }

    public function getAllProducts(
        array $columns = ['*'],
        array $joins = [],
        array $where = [],
        int $limit = 0
    ) {
        return $this->db->selectData($this->tableName, $columns, $joins, $where, $limit);
    }

    public function getProductById($id)
    {
        return $this->db->selectData(
            'products', 
            ['*'],      
            [],         
            ['id' => $id], 
            1           
        )[0] ?? null;
    }

    public function createProduct($data)
    {
        return $this->create($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteProduct($id)
    {
        $this->db->deleteRecord($this->tableName, $id);
    }

    public function restoreProduct()
    {
        return $this->restore();
    }
}
