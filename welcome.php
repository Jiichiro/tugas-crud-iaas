<?php
$host = "localhost";
$dbname = "website"; // Ganti dengan nama database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda

// Inisialisasi variabel
$pemasukan = [];
$pengeluaran = [];

try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mengambil data pemasukan bulan ini
    $bulanIni = date('Y-m'); // Format tahun-bulan
    $stmtPemasukan = $pdo->prepare("SELECT tanggal, jumlah FROM pemasukan WHERE DATE_FORMAT(tanggal, '%Y-%m') = :bulan");
    $stmtPemasukan->execute(['bulan' => $bulanIni]);
    $pemasukan = $stmtPemasukan->fetchAll(PDO::FETCH_ASSOC);

    // Mengambil data pengeluaran bulan ini
    $stmtPengeluaran = $pdo->prepare("SELECT tanggal, jumlah FROM pengeluaran WHERE DATE_FORMAT(tanggal, '%Y-%m') = :bulan");
    $stmtPengeluaran->execute(['bulan' => $bulanIni]);
    $pengeluaran = $stmtPengeluaran->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    header {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 10px;
    }

    /* Styling untuk logo */
    .logo {
        max-width: 150px;
        /* Sesuaikan ukuran logo */
        height: 50px;
    }

    /* Memastikan logo berada di pojok kiri atas */
    header {
        position: fixed;
        top: 0;
        right: 0;
        width: 100px;
        z-index: 1000;
    }

    @font-face {
        font-family: 'CustomFont';
        src: url('Poppins-Light.ttf') format('truetype');
    }
</style>

<body>
    <?php include "sideBar.php";?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Kas Kelas</span>
        </div>
        <div class="p-10 pt-8 m-8 bg-white rounded-lg shadow-xl">
            <h1 class="text-2xl font-bold mb-4">Pemasukan Bulan Ini</h1>
            <table class="min-w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">Tanggal</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Jumlah (IDR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($pemasukan): ?>
                        <?php foreach ($pemasukan as $row): ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['tanggal']); ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo number_format($row['jumlah'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2" colspan="2">Tidak ada data pemasukan untuk bulan ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h1 class="text-2xl font-bold mt-8 mb-4">Pengeluaran Bulan Ini</h1>
            <table class="min-w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">Tanggal</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Jumlah (IDR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($pengeluaran): ?>
                        <?php foreach ($pengeluaran as $row): ?>
                            <tr>
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['tanggal']); ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo number_format($row['jumlah'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2" colspan="2">Tidak ada data pengeluaran untuk bulan ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </section>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>

</body>

</html>