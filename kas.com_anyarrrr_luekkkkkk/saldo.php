<?php

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

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM saldo WHERE akun_id");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Saldo</title>
</head>
<body>
    <h1>Cek Saldo</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Jumlah Pembayaran</th>
            <th>Jumlah Saldo</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['jumlah_pembayaran']; ?></td>
            <td><?php echo $row['jumlah_saldo']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="welcome.php">Kembali</a>
</body>
</html>