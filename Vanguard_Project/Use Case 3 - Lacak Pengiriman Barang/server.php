<?php
require_once 'Tracking.php';

// Mendapatkan metode HTTP dan URI
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['PATH_INFO'] ?? '/';
$uri = explode('/', trim($uri, '/')); // Memisahkan URI menjadi array
$resource = $uri[0] ?? null;

// Fungsi untuk mengirimkan respons JSON
function sendResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Proses berdasarkan metode HTTP
switch ($method) {
    case 'GET': // Mendapatkan data pelacakan
        if ($resource === 'tracking' && isset($uri[1])) {
            $orderId = $uri[1];
            $trackingService = new TrackingService();
            $trackingData = $trackingService->getTrackingStatus($orderId);

            sendResponse($trackingData); // Kirim data pelacakan
        } else {
            sendResponse(["error" => "Invalid resource or order ID missing"], 400);
        }
        break;

    case 'POST': // Simulasi pembuatan data pelacakan
        if ($resource === 'tracking') {
            $input = json_decode(file_get_contents("php://input"), true);

            // Validasi input
            if (!isset($input['orderId']) || empty($input['orderId'])) {
                sendResponse(["error" => "Order ID is required"], 400);
            }

            // Simulasi respons sukses
            $response = [
                "message" => "Tracking data successfully created",
                "orderId" => $input['orderId'],
                "status" => "Created"
            ];
            sendResponse($response, 201);
        } else {
            sendResponse(["error" => "Invalid resource for POST request"], 400);
        }
        break;

    case 'PUT': // Simulasi pembaruan data pelacakan
        if ($resource === 'tracking') {
            $input = json_decode(file_get_contents("php://input"), true);

            // Validasi input
            if (!isset($input['orderId']) || empty($input['orderId'])) {
                sendResponse(["error" => "Order ID is required"], 400);
            }
            if (!isset($input['status']) || empty($input['status'])) {
                sendResponse(["error" => "Status is required"], 400);
            }

            // Simulasi pembaruan status
            $response = [
                "message" => "Tracking data updated successfully",
                "orderId" => $input['orderId'],
                "status" => $input['status']
            ];
            sendResponse($response);
        } else {
            sendResponse(["error" => "Invalid resource for PUT request"], 400);
        }
        break;

    case 'DELETE': // Simulasi penghapusan data pelacakan
        if ($resource === 'tracking' && isset($uri[1])) {
            $orderId = $uri[1];

            // Simulasi penghapusan data
            $response = [
                "message" => "Tracking data deleted successfully",
                "orderId" => $orderId
            ];
            sendResponse($response);
        } else {
            sendResponse(["error" => "Invalid resource or order ID not provided"], 400);
        }
        break;

    default: // Metode tidak didukung
        sendResponse(["error" => "Method not allowed"], 405);
        break;
}
