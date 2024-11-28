<?php
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['PATH_INFO'];
$uri = explode("/", $uri);
$uri = array_filter($uri);
$body = file_get_contents("php://input");

// Fungsi untuk mengirim respons JSON
function out($data) {
    header('content-type:application/json');
    echo json_encode($data);
    exit;
}

// Switch berdasarkan metode HTTP
switch ($method) {
    case 'POST': // Endpoint untuk pengajuan pengembalian barang
        $fun = array_shift($uri);
        if ($fun == 'returnRequest') {
            $returnRequest = json_decode($body);

            // Simpan data pengembalian ke database (simulasi)
            $result = new stdClass;
            $result->product_name = $returnRequest->product_name;
            $result->resi_number = $returnRequest->resi_number;
            $result->return_address = $returnRequest->return_address;
            $result->status = "Pengajuan Diterima";

            out(array(
                "message" => "Pengajuan pengembalian berhasil dibuat.",
                "data" => $result
            ));
        }
        break;

    default:
        http_response_code(405); // Method Not Allowed
        out(array("error" => "Method Not Allowed"));
        break;
}
