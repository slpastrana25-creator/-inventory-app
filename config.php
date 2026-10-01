<?php
// Replace with the values from your InfinityFree control panel (MySQL Databases)
$DB_HOST = 'sql213.infinityfree.com';          // InfinityFree: e.g. sql123.infinityfree.com
$DB_USER = 'if0_43057636';               // InfinityFree: e.g. if0_12345678
$DB_PASS = 'fK85QbjmuLSa';
$DB_NAME = 'inventory_db';       // InfinityFree: e.g. if0_12345678_inventory

mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
