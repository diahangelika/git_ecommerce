<?php
require_once(__DIR__ . '/../Controller/CategoryController.php');

$id = $_GET['id'];

$categoryController = new CategoryController();
$categories = $categoryController->show($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $kategori = $_POST["kategori"];
  $data = [
    "kategori" => $kategori
  ];

      if ($categoryController->update($id, $data)) {
          header("Location: ../index.php");
          exit;
      } else {
          echo "Error";
      }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UPDATE KATEGORI</title>
</head>
<body>
  <h2>Update Category</h2>
  <a href="../index.php">Back to Category</a>
  <br><br>
  <?php if($categories) : ?>
    <form action="" method="POST">
      <input type="text" name="id" value="<?php echo $categories['id']; ?>">
      <br><br>
      <label for="kategori">category Name: </label>
      <input type="text" name="kategori" value="<?php echo $categories['kategori']; ?>" required>
      <br><br>
      <input type="submit" value="Update Category">
    </form>
  <?php else : ?>
    <p>Data not found</p>
  <?php endif ?>
</body>
</html>

