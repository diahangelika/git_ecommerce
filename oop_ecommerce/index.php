<?php
require_once(__DIR__ . '/Controller/CategoryController.php');

$categoryController = new CategoryController();
$categories = $categoryController->index();

// call category index

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreAllcategories"])) {
    $categoryController->restore();
    header("Location: ../index.php");
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
<h2>Kategori List</h2>
    <a href="View/CategoryCreateView.php">Add Category</a>
    <br>
    <a href="../oop_ecommerce/index2.php">Back to products</a>
    <br><br>
    <form action="" method="POST">
        <input type="submit" name="restoreAllcategories" value="Restore All Categories">
    </form>
    <br><br>
    <table>
      <tr>
        <th>No</th>
        <th>Id</th>
        <th>Category Name</th>
        <th>Action</th>
      </tr>

      <?php if(count($categories) > 0) : ?>
        <?php $counter = 1 ?>
        <?php foreach ($categories as $category) : ?>
          <?php if ($category["isDeleted"] === 0 ) : ?>
          <tr>
            <td><?php echo $counter ?></td>
            <td><?php echo $category["id"] ?></td>
            <td><?php echo $category["kategori"] ?></td>
            <td>
              <a href="View/CategoryDetailView.php?id=<?php echo $category["id"] ?>">View</a>
              <a href="View/CategoryUpdateView.php?id=<?php echo $category["id"] ?>">Update</a>
              <a href="View/CategoryDeleteView.php?id=<?php echo $category["id"] ?>">Delete</a>
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