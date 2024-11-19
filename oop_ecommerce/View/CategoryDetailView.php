<?php
require_once(__DIR__ . '/../Controller/CategoryController.php');

$id = $_GET['id'];

$categoryController = new CategoryController();
$categories = $categoryController->show($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DETAIL KATEGORI</title>
</head>
<body>
  <h2>Detail Category</h2>
  <a href="../index.php">Back to Category</a>
  <br><br>
  <?php if($categories) : ?>
    <table>
      <tr>
        <td>ID: </td>
        <td><?php echo $categories["id"]; ?></td>
      </tr>
      <tr>
        <td>Category Name: </td>
        <td><?php echo $categories["kategori"]; ?></td>
      </tr>
    </table>
  <?php else : ?>
    <p>Data not found</p>
  <?php endif ?>
</body>
</html>