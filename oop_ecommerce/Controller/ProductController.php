<?php

require_once(__DIR__ . '/../Config/init.php');

class ProductController
{
  private $productModel;

  public function __construct()
  {
    $this->productModel = new Product();
  }

  public function index()
  {
    $columns = ['products.id', 'products.product_name',  'categories.kategori', 'products.harga', 'products.stok', 'products.isDeleted'];
    $joins = ['categories' => 'products.id_kategori = categories.id'];

    return $this->productModel->getAllProducts($columns, $joins);
  }

  public function create($data)
  {
    $createProduct = $this->productModel->createProduct($data);
    return $createProduct;
  }

  public function show($id)
  {
    $getProductById = $this->productModel->getProductById($id);
    // return $getProductById ? $getProductById[0] : null;
    // return $this->productModel->getProductById($id);
    return $getProductById; //
  }

  public function update($id, $data)
  {
    $updateProduct = $this->productModel->updateProduct($id, $data);
    return $updateProduct;
  }

  public function destroy($id)
  {
    $this->productModel->deleteProduct($id);
    $deleteProduct = $this->productModel->getProductById($id);
    return $deleteProduct === null || empty($getProductById);
  }

  public function restore()
  {
    $this->productModel->restoreProduct();
    header('Location: /oop_ecommerce/index2.php');
    exit;
  }
}
