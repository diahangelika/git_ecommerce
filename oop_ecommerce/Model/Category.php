<?php
require_once(__DIR__ . '/../Lib/Model.php');

class Category extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('categories');
    }

    public function getAllCategories(
        array $columns = ['*'],
        array $joins = [],
        array $where = [],
        int $limit = 0
    ) {
        return $this->db->selectData($this->tableName, $columns, $joins, $where, $limit);
    }

    public function getCategoryById($id)
    {
        return $this->db->selectData(
            'categories', 
            ['*'],      
            [],         
            ['id' => $id], 
            1           
        )[0] ?? null;
    }

    // public function getCategoryById($id)
    // {
    //     return $this->getById($id);
    // }

    public function createCategory($data)
    {
        return $this->create($data);
    }

    public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCategory($id)
    {
        $this->db->deleteRecord($this->tableName, $id);
    }

    public function restoreCategory()
    {
        return $this->restore();
    }
}
