<?php
require_once 'includes/functions.php';

header('Content-Type: application/json');

$query = $_GET['q'] ?? '';

if (empty($query) || strlen($query) < 2) {
    echo json_encode([]);
    exit;
}

$results = searchContent($query, 15);

echo json_encode($results);

