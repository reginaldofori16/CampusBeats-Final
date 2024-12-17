<?php
ini_set('display_errors', 0);
require_once '../db/db.php';

header('Content-Type: application/json');
ob_clean();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchQuery = $_POST['searchQuery'] ?? '';

    if (empty($searchQuery)) {
        echo json_encode(['success' => false, 'message' => 'Search query is required.']);
        exit;
    }

    try {
        // Modified query to handle NULL values and include only necessary fields
        $stmt = $conn->prepare("
            SELECT t.title AS track_name, 
                   COALESCE(a.stage_name, 'Unknown Artist') AS artist_name 
            FROM tracks t
            LEFT JOIN artists a ON t.artist_id = a.artist_id
            WHERE t.title LIKE ? OR a.stage_name LIKE ?
        ");

        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
            exit;
        }

        $searchParam = '%' . $searchQuery . '%';
        $stmt->bind_param("ss", $searchParam, $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $tracks = [];
        while ($row = $result->fetch_assoc()) {
            $tracks[] = $row;
        }

        echo json_encode(['success' => true, 'tracks' => $tracks]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
