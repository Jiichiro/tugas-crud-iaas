<?php
include 'sideBar.php';
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
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Upload Data Saldo</span>
        </div>
        <div class="m-8 p-10 bg-white rounded-md shadow-xl">
            <form action="" method="POST">
                <label for="akun_id">Akun ID</label>
                <input type="number" name="akun_id" placeholder="1" required class="block bg-gray border border-gray-700 rounded-sm p-1"><br>
    
                <label for="jumlah_pembayaran">Jumlah Pembayaran (IDR):</label>
                <input type="number" name="jumlah_pembayaran" placeholder="10.000" step="0.01" required class="block"><br>
    
                <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                <input type="date" name="tanggal_pembayaran" placeholder="1/1/2024" required class="block"><br>
    
                <label for="jumlah_saldo">Jumlah Saldo (IDR):</label>
                <input type="number" name="jumlah_saldo" placeholder="2.000.000" step="0.01" required class="block"><br>
    
                <input type="submit" value="Upload">
            </form>
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