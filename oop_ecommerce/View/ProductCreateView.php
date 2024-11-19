<?php
require_once(__DIR__ . '/../Controller/ProductController.php');
require_once(__DIR__ . '/../Controller/CategoryController.php');

$productController = new ProductController();
$categoryController = new CategoryController();
$categories = $categoryController->index();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (empty($_POST["product_name"])) {
      $errors['product_name'] = "Product Name is required";
    } else {
        $product_name = $_POST["product_name"];
    }
  
    if (empty($_POST["harga"])) {
        $errors['harga'] = "harga is required";
    } else if (is_numeric($_POST["harga"]) == false) {
        $errors['harga'] = "harga must be a number";
    } else if (floatval($_POST["harga"]) <= 0) {
        $errors['harga'] = "harga should be greater than zero";
    } else {
        $harga = $_POST["harga"];
    }
   
    if (!isset($_POST["stok"]) || empty($_POST["stok"])) {
        $errors['stok'] = "stok is required";
    } else if (!is_numeric($_POST["stok"])) {
        $errors['stok'] = "stok must be a valid number";
    } else if ((int)$_POST["stok"] < 0) {
        $errors['stok'] = "stok cannot be negative";
    } else if ($_POST["stok"] != (string)(int)$_POST["stok"]) {
        $errors['stok'] = "stok must be an integer";
    } else {
        $stok = $_POST["stok"];
    }

  if (empty($errors)) {
    $data = [
      'product_name' => $product_name,
      'id_kategori' => $_POST['id_kategori'],
      'harga' => $harga,
      'stok' => $stok
    ];
      if ($productController->create($data)) {
        echo "<script>alert('Product added successfully!');</script>";
        header("Location: ../index2.php");
        exit();
      } else {
          echo "<script>alert('Failed to add Product!');</script>";
      }
  }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CREATE PRODUCT</title>
</head>
<body>
  <h2>CREATE PRODUCT</h2>
  <a href="../index2.php">Back to Product</a>
  <br><br>
  <form action="" method="POST">
    <label for="product_name">Product name : </label>
    <input type="text" name="product_name" required>
    <br><br>

    <label for="id_kategori">Category : </label>
    <select class="form-select" name="id_kategori" required>
      <?php foreach($categories as $category) : ?>
        <option value="<?=$category['id']?>"> 
          <?=$category['kategori']?>
        </option>
      <?php endforeach; ?>
    </select>
    
    <br><br>
    <label for="harga">Price : </label>
    <input ty pe="number" name="harga" required>
    <br><br>
    <label for="stok">Stock : </label>
    <input type="number" name="stok" required>
    <br><br><br>
    <input type="submit" value="Add Product">
  </form>
</body>
</html>