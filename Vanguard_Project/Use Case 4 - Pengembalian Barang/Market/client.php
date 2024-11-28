<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form home.php
    $product_name = $_POST['product_name'];
    $resi_number = $_POST['resi_number'];
    $return_address = $_POST['return_address'];

    // Data JSON untuk dikirim ke server.php
    $body = new stdClass;
    $body->product_name = $product_name;
    $body->resi_number = $resi_number;
    $body->return_address = $return_address;

    // Konfigurasi REST API
    $url = 'http://localhost/rest3/DNS/server.php/returnRequest'; // Endpoint server API
    $method = 'POST';

    $options = array(
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => array('content-type:application/json'),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
    );

    // Eksekusi CURL
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Tampilkan hasil
    if ($http_status == 200) {
        echo "<h1>Pengajuan Pengembalian Berhasil</h1>";
        echo "<p>Respon dari server: $result</p>";
    } else {
        echo "<h1>Pengajuan Pengembalian Gagal</h1>";
        echo "<p>Respon dari server: $result</p>";
    }
}

