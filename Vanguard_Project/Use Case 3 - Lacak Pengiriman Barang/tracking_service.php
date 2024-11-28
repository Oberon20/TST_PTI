<?php
require_once 'Tracking.php';

// Tentukan metode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Fungsi untuk mengirimkan respons JSON
function sendResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Proses permintaan berdasarkan metode HTTP
if ($method === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    // Validasi input
    if (!isset($input['orderId']) || empty($input['orderId'])) {
        sendResponse(["error" => "Order ID is required"], 400);
    }

    // Proses pelacakan
    $trackingService = new TrackingService();
    $trackingData = $trackingService->getTrackingStatus($input['orderId']);

    // Kirim respons pelacakan
    sendResponse($trackingData);
} else {
    sendResponse(["error" => "Invalid HTTP method"], 405);
}
