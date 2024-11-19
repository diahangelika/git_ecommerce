<?php

require_once(__DIR__ . '/../Model/Category.php');

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();

    }

    public function index()
    {
      $categories = $this->categoryModel->getAllCategories();
      return $categories;
    }

    public function create($data)
    {
      $createCategory = $this->categoryModel->createCategory($data);
      return $createCategory;
    }

    public function show($id)
    {
      $getCategoryById = $this->categoryModel->getCategoryById($id);
      return $getCategoryById;
      // return $getCategoryById ? $getCategoryById[0] : null;
    }

    public function update($id, $data)
    {
      $updateCategory = $this->categoryModel->updateCategory($id, $data);
      return $updateCategory;
    }

    public function destroy($id)
    {
      $this->categoryModel->deleteCategory($id);
      $deleteCategory = $this->categoryModel->getCategoryById($id);
      return $deleteCategory === null || empty($getCategoryById);
    }

    public function restore()
    {
        $this->categoryModel->restoreCategory();  
        header('Location: /oop_ecommerce/index.php');
        exit;
    }
}
