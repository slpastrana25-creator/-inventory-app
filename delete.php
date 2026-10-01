<?php
require 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $m = $stmt->affected_rows > 0 ? 'Product deleted.' : 'Product not found.';
    header('Location: index.php?msg=' . urlencode($m));
    exit;
}
header('Location: index.php');
