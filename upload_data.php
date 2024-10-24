<?php
// Konfigurasi database
$host = "localhost";
$dbname = "website"; // Ganti dengan nama database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda

try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mengambil data dari form
        $akun_id = $_POST['akun_id'];
        $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
        $jumlah_saldo = $_POST['jumlah_saldo'];

        // Menyimpan data ke database
        $stmt = $pdo->prepare("INSERT INTO saldo (akun_id, jumlah_pembayaran, tanggal_pembayaran, jumlah_saldo) VALUES (:akun_id, :jumlah_pembayaran, :tanggal_pembayaran, :jumlah_saldo)");
        $stmt->execute([
            'akun_id' => $akun_id,
            'jumlah_pembayaran' => $jumlah_pembayaran,
            'tanggal_pembayaran' => $tanggal_pembayaran,
            'jumlah_saldo' => $jumlah_saldo
        ]);

        echo "Data saldo berhasil diupload!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Data Saldo</title>
</head>
<body>
    <h1>Upload Data Saldo</h1>
    <form action="" method="POST">
        <label for="akun_id">Akun ID:</label>
        <input type="number" name="akun_id" required><br><br>
        
        <label for="jumlah_pembayaran">Jumlah Pembayaran (IDR):</label>
        <input type="number" name="jumlah_pembayaran" step="0.01" required><br><br>
        
        <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
        <input type="date" name="tanggal_pembayaran" required><br><br>
        
        <label for="jumlah_saldo">Jumlah Saldo (IDR):</label>
        <input type="number" name="jumlah_saldo" step="0.01" required><br><br>
        
        <input type="submit" value="Upload">
    </form>
</body>
</html>
