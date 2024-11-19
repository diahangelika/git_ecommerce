<?php
require_once(__DIR__ . '/../Controller/CategoryController.php');

$categoryController = new CategoryController();

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  if (empty($_POST["kategori"])) {
      $errors['kategori'] = "Kategori Name is required";
  } else {
      $data = ["kategori" => $_POST["kategori"]];
  }

  if (empty($errors)) {
      if ($categoryController->create($data)) {
          echo "<script>alert('Category added successfully!');</script>";
          header("Location: ../index.php");
          exit();
      } else {
          echo "<script>alert('Failed to add Category!');</script>";
      }
  }
} 

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CREATE KATEGORI</title>
</head>
<body>
  <h2>CREATE KATEGORI</h2>
  <a href="../index.php">Back to KATEGORI</a>

  <br><br>
  <form action="" method="POST">
  <label for="kategori">Kategori Name: </label>
  <input type="text" name="kategori" required>
    <br>
    <input type="submit" value="Add Kategori">
</form>

  
</body>
</html>