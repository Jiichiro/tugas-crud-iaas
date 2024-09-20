<?php
session_start();

// Koneksi ke database
$host = 'localhost'; // Ganti dengan host database Anda
$db = 'website'; // Ganti dengan nama database Anda
$user = 'root'; // Ganti dengan username database Anda
$pass = ''; // Ganti dengan password database Anda

$conn = new mysqli($host, $user, $pass, $db);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$saldo = null;
$error = '';
$user_id = null;

// Cek apakah user sudah login


// Query untuk mendapatkan saldo berdasarkan akun_id
$stmt = $conn->prepare("SELECT * FROM saldo WHERE akun_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result(); // Didefinisikan di sini

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Saldo</title>
</head>
<body>
    <h1>Cek Saldo</h1>
    <table border="1">
        <tr>
            <th>Jumlah Pembayaran</th>
            <th>Tanggal Pembayaran</th>
            <th>Jumlah Saldo</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>Rp <?= number_format($row['jumlah_pembayaran'], 2, ',', '.') ?></td>
                    <td><?= $row['tanggal_pembayaran'] ?></td>
                    <td>Rp <?= number_format($row['jumlah_saldo'], 2, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Tidak ada data saldo.</td>
            </tr>
        <?php endif; ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
