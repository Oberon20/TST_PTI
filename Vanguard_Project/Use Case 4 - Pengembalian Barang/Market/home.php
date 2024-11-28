<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Formulir Pengembalian Barang</h1>
    <form method="post" action="client.php">
        <label for="product_name">Nama Produk:</label>
        <input type="text" name="product_name" id="product_name" required><br>

        <label for="resi_number">Nomor Resi:</label>
        <input type="text" name="resi_number" id="resi_number" required><br>

        <label for="return_address">Alamat Pengembalian:</label>
        <textarea name="return_address" id="return_address" required></textarea><br>

        <button type="submit">Ajukan Pengembalian</button>
    </form>
</body>
</html>
