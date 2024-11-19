<?php
require_once(__DIR__ . '/../Controller/ProductController.php');

$id = $_GET['id'];

$productController = new ProductController();
$products = $productController->show($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DETAIL PRODUK</title>
</head>
<body>
  <h2>Detail Product</h2>
  <a href="../index2.php">Back to Product</a>
  <br><br>
  <?php if($products) : ?>
    <table>
      <tr>
        <td>Product Name: </td>
        <td><?php echo $products["product_name"]; ?></td>
      </tr>
      <tr>
        <td>Category Name: </td>
        <td><?php echo $products["id_kategori"]; ?></td>
      </tr>
      <tr>
        <td>Harga: </td>
        <td><?php echo $products["harga"]; ?></td>
      </tr>
      <tr>
        <td>Stock: </td>
        <td><?php echo $products["stok"]; ?></td>
      </tr>
    </table>
  <?php else : ?>
    <p>Data not found</p>
  <?php endif ?>
</body>
</html>