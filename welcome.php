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
<h1>Pemasukan Bulan Ini</h1>
    <table border="1">
        <tr><th>Tanggal</th><th>Jumlah (IDR)</th></tr>
        <?php if ($pemasukan): ?>
            <?php foreach ($pemasukan as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                    <td><?php echo number_format($row['jumlah'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">Tidak ada data pemasukan untuk bulan ini.</td></tr>
        <?php endif; ?>
    </table>

    <h1>Pengeluaran Bulan Ini</h1>
    <table border="1">
        <tr><th>Tanggal</th><th>Jumlah (IDR)</th></tr>
        <?php if ($pengeluaran): ?>
            <?php foreach ($pengeluaran as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                    <td><?php echo number_format($row['jumlah'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">Tidak ada data pengeluaran untuk bulan ini.</td></tr>
        <?php endif; ?>
    </table>
    <header>
        <img src="assets/images/profile.png" alt="Logo" class="logo" onclick="window.location.href='./profile.php'">
    </header>
    <div class="sidebar close">
        <div class="logo-details">
            <p class="bx textcustom" style="color: #ffbf36; margin:45px 0 50px 30px; font-size:22px;">K</p>
            <span class="logo_name textcustom">as</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="./saldo.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Cek Saldo</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Edit Data</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-collection'></i>
                        <span class="link_name">Edit/Upload Data</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Category</a></li>
                    <li><a href="./upload_data.php">Upload Data</a></li>
                    <li><a href="#">Edit Data</a></li>
                    <li><a href="#">PHP & MySQL</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-book-alt'></i>
                        <span class="link_name">Posts</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Posts</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Login Form</a></li>
                    <li><a href="#">Card Design</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-line-chart'></i>
                    <span class="link_name">Chart</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Chart</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class='bx bx-plug'></i>
                        <span class="link_name">Plugins</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Plugins</a></li>
                    <li><a href="#">UI Face</a></li>
                    <li><a href="#">Pigments</a></li>
                    <li><a href="#">Box Icons</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-compass'></i>
                    <span class="link_name">Explore</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Explore</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-history'></i>
                    <span class="link_name">History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">History</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Setting</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Setting</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">

                    <div class="name-job">
                        <i class='bx bx-log-in'></i>
                    </div>
                    <div class="navbar">
                        <div class="logout-icon">
                            <a href="logout.php">
                                <i class='bx bx-log-out'></i>
                            </a>
                        </div>
                    </div>

            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Kas Kelas</span>
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

