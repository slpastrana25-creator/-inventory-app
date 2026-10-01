<?php
// Handles both CREATE (no id) and UPDATE (with id)
require 'config.php';
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$product = ['name' => '', 'category' => '', 'quantity' => 0, 'price' => '0.00'];
$errors = [];

if ($id > 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $found = $stmt->get_result()->fetch_assoc();
    if (!$found) { header('Location: index.php?msg=' . urlencode('Product not found.')); exit; }
    $product = $found;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product['name']     = trim($_POST['name'] ?? '');
    $product['category'] = trim($_POST['category'] ?? '');
    $product['quantity'] = $_POST['quantity'] ?? '';
    $product['price']    = $_POST['price'] ?? '';

    if ($product['name'] === '' || strlen($product['name']) > 100) $errors[] = 'Name is required (max 100 characters).';
    if ($product['category'] === '' || strlen($product['category']) > 50) $errors[] = 'Category is required (max 50 characters).';
    if (!ctype_digit((string)$product['quantity'])) $errors[] = 'Quantity must be a whole number, 0 or more.';
    if (!is_numeric($product['price']) || $product['price'] < 0) $errors[] = 'Price must be a number, 0 or more.';

    if (!$errors) {
        $qty = (int)$product['quantity'];
        $price = (float)$product['price'];
        if ($id > 0) {
            $stmt = $conn->prepare("UPDATE products SET name=?, category=?, quantity=?, price=? WHERE id=?");
            $stmt->bind_param('ssidi', $product['name'], $product['category'], $qty, $price, $id);
            $m = 'Product updated.';
        } else {
            $stmt = $conn->prepare("INSERT INTO products (name, category, quantity, price) VALUES (?,?,?,?)");
            $stmt->bind_param('ssid', $product['name'], $product['category'], $qty, $price);
            $m = 'Product added.';
        }
        if ($stmt->execute()) { header('Location: index.php?msg=' . urlencode($m)); exit; }
        $errors[] = 'Database error. Please try again.';
    }
}
$title = $id > 0 ? 'Edit Product' : 'Add Product';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title) ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container narrow">
  <header><h1><?= e($title) ?></h1></header>

  <?php foreach ($errors as $err): ?><div class="alert error"><?= e($err) ?></div><?php endforeach; ?>

  <form method="post" class="card" id="productForm">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Product Name <input type="text" name="name" maxlength="100" required value="<?= e($product['name']) ?>"></label>
    <label>Category <input type="text" name="category" maxlength="50" required value="<?= e($product['category']) ?>"></label>
    <label>Quantity <input type="number" name="quantity" min="0" step="1" required value="<?= e($product['quantity']) ?>"></label>
    <label>Price (₱) <input type="number" name="price" min="0" step="0.01" required value="<?= e($product['price']) ?>"></label>
    <div class="row">
      <button class="btn" type="submit">Save</button>
      <a class="btn secondary" href="index.php">Cancel</a>
    </div>
  </form>
</div>
<script src="app.js"></script>
</body>
</html>
