<?php
require 'config.php';
$search = trim($_GET['q'] ?? '');
if ($search !== '') {
    $like = "%$search%";
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ? ORDER BY id DESC");
    $stmt->bind_param('ss', $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
}
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Inventory</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <header>
    <h1>📦 Product Inventory</h1>
    <a class="btn" href="form.php">+ Add Product</a>
  </header>

  <?php if ($msg): ?><div class="alert"><?= e($msg) ?></div><?php endif; ?>

  <form class="search" method="get">
    <input type="text" name="q" placeholder="Search name or category…" value="<?= e($search) ?>">
    <button class="btn" type="submit">Search</button>
  </form>

  <div class="table-wrap">
  <table>
    <thead><tr><th>ID</th><th>Name</th><th>Category</th><th>Qty</th><th>Price (₱)</th><th>Actions</th></tr></thead>
    <tbody>
    <?php if ($result->num_rows === 0): ?>
      <tr><td colspan="6" class="empty">No products found.</td></tr>
    <?php endif; ?>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= (int)$row['id'] ?></td>
        <td><?= e($row['name']) ?></td>
        <td><?= e($row['category']) ?></td>
        <td class="<?= $row['quantity'] <= 10 ? 'low' : '' ?>"><?= (int)$row['quantity'] ?></td>
        <td><?= number_format($row['price'], 2) ?></td>
        <td class="actions">
          <a class="btn small" href="form.php?id=<?= (int)$row['id'] ?>">Edit</a>
          <form method="post" action="delete.php" onsubmit="return confirm('Delete this product?');">
            <input type="hidden" name="id" value="<?= (int)$row['id'] ?>">
            <button class="btn small danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
  </div>
</div>
</body>
</html>
