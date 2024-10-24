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

    // Inisialisasi variabel
    $data = null;

    // Debugging: Tampilkan parameter GET
    var_dump($_GET); // Tambahkan ini untuk memeriksa nilai GET

    // Cek apakah ada ID yang dikirim melalui URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Mengambil data saldo berdasarkan ID
        $stmt = $pdo->prepare("SELECT * FROM saldo WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            die("Data tidak ditemukan.");
        }
    } else {
        die("ID tidak ditemukan.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mengambil data dari form
        $akun_id = $_POST['akun_id'];
        $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
        $jumlah_saldo = $_POST['jumlah_saldo'];

        // Memperbarui data ke database
        $stmt = $pdo->prepare("UPDATE saldo SET akun_id = :akun_id, jumlah_pembayaran = :jumlah_pembayaran, tanggal_pembayaran = :tanggal_pembayaran, jumlah_saldo = :jumlah_saldo WHERE id = :id");
        $stmt->execute([
            'akun_id' => $akun_id,
            'jumlah_pembayaran' => $jumlah_pembayaran,
            'tanggal_pembayaran' => $tanggal_pembayaran,
            'jumlah_saldo' => $jumlah_saldo,
            'id' => $id
        ]);

        echo "Data saldo berhasil diperbarui!";
        // Redirect atau dapat menggunakan header('Location: halaman_sukses.php') jika ingin
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
    <title>Edit Data Saldo</title>
</head>
<body>
    <h1>Edit Data Saldo</h1>
    <?php if ($data): ?>
        <form action="" method="POST">
            <label for="akun_id">Akun ID:</label>
            <input type="number" name="akun_id" value="<?php echo htmlspecialchars($data['akun_id']); ?>" required><br><br>
            
            <label for="jumlah_pembayaran">Jumlah Pembayaran (IDR):</label>
            <input type="number" name="jumlah_pembayaran" step="0.01" value="<?php echo htmlspecialchars($data['jumlah_pembayaran']); ?>" required><br><br>
            
            <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
            <input type="date" name="tanggal_pembayaran" value="<?php echo htmlspecialchars($data['tanggal_pembayaran']); ?>" required><br><br>
            
            <label for="jumlah_saldo">Jumlah Saldo (IDR):</label>
            <input type="number" name="jumlah_saldo" step="0.01" value="<?php echo htmlspecialchars($data['jumlah_saldo']); ?>" required><br><br>
            
            <input type="submit" value="Update">
        </form>
    <?php else: ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>
</body>
</html>
