<?php
require_once(__DIR__ . '/../Controller/ProductController.php');

$id = $_GET['id'];

$productController = new ProductController();
$products = $productController->show($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($productController->destroy($id)) {
      header("Location: ../index2.php");
      exit;
  } else {
      echo "Error: Category could not be deleted.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DETAIL PRODUK</title>
</head>
<body>
  <h2>Delete Product</h2>
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
    <form action="" method="POST">
      <input type="hidden" name="id" value="<?php echo $products['id']; ?>">
      <input type="submit" value="Delete Product">
    </form>
  <?php else : ?>
    <p>Data not found</p>
  <?php endif ?>
</body>
</html>