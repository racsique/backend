<?php

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

require_once __DIR__ . '/../config/database.php';

$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 100;
if ($limit < 1 || $limit > 500) {
    $limit = 100;
}

$stmt = $conn->prepare(
    "SELECT id, full_name, email, phone, gender, id_number, department,
            person_to_visit, purpose, visit_date, time_in, time_out, status, created_at
     FROM visitors
     ORDER BY id DESC
     LIMIT ?"
);
$stmt->bind_param('i', $limit);
$stmt->execute();
$result = $stmt->get_result();

$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

echo json_encode([
    'success' => true,
    'count' => count($requests),
    'requests' => $requests,
    'server_time' => date('Y-m-d H:i:s')
]);

$stmt->close();
$conn->close();
