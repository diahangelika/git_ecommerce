<?php
require_once(__DIR__ . '/Controller/ProductController.php');

$productController = new ProductController();
$products = $productController->index();

// var_dump($products);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreAllproducts"])) {
    $productController->restore();
    header("Location: ../index2.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Lists</title>
    <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, 
    td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    th{
      background-color: lightcyan;
    }
  </style>
</head>

<body>
<h2>Produk List</h2>
    <a href="View/ProductCreateView.php">Add Product</a>
    <br>
    <a href="../oop_ecommerce/index.php">See Categories</a>
    <br><br>
    <form action="" method="POST">
        <input type="submit" name="restoreAllproducts" value="Restore All Products">
    </form>
    <br><br>
    <table>
      <tr>
        <th>No</th>
        <th>Product Name</th>
        <th>Category Name</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Action</th>
      </tr>

      <?php if($products) : ?>
       
        <?php $counter = 1 ?>
        <?php foreach ($products as $product) : ?>
          <?php if ($product["isDeleted"] === 0 ) : ?>
            <tr>
              <td><?php echo $counter ?></td>
              <td><?php echo $product["product_name"] ?></td>
              <td><?php echo $product["kategori"] ?></td>
              <td><?php echo $product["harga"] ?></td>
              <td><?php echo $product["stok"] ?></td>
              <td>
                <a href="View/ProductDetailView.php?id=<?php echo $product["id"] ?>">View</a>
                <a href="View/ProductUpdateView.php?id=<?php echo $product["id"] ?>">Update</a>
                <a href="View/ProductDeleteView.php?id=<?php echo $product["id"] ?>">Delete</a>
              </td>
            </tr>
          <?php $counter ++ ?>
          <?php endif ?>
        <?php endforeach ?>
       
      <?php else : ?>
        <tr>
          <td colspan="5">0 result</td>
        </tr>
      <?php endif ?>
    </table>
</body>

</html>