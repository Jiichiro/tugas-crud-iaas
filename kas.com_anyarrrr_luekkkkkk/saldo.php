<?php
include "koneksi.php";

// Periksa koneksi
if ($kon->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// $user_id = $_SESSION['user_id'];
$result = $kon->query("SELECT * FROM saldo WHERE akun_id");

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