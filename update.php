<?php
include "sideBar.php"
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Data</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> -->
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
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";
    $id = $_GET['id']; 
    $ambil = mysqli_query($kon,"SELECT * FROM `saldo` WHERE `id`= $id");
    $tampil = mysqli_fetch_assoc($ambil);
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
        $tanggal_pembayaran = $_POST['tanggal_pembayaran'];
        $jumlah_saldo = $_POST['jumlah_saldo'];
    
        $query ="UPDATE `saldo` SET
        id = '$id',
        jumlah_pembayaran = '$jumlah_pembayaran',
        tanggal_pembayaran = '$tanggal_pembayaran',
        jumlah_saldo = '$jumlah_saldo'
        WHERE id = $id
        ";
        mysqli_query($kon,$query);
        if (mysqli_affected_rows($kon) > 0) {
            echo "<script>
            alert('DATA BERHASIL DIUBAH');
            document.location.href='saldo.php';
        </script>";
        }
    }
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    // function input($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }
    // $id = $_GET['id']; 
    // //Cek apakah ada nilai yang dikirim menggunakan method GET dengan nama id
    // if (isset($_GET['id'])) {
    //     $id=input($_GET["id"]);

    //     $sql="select * from saldo where id=$id";
    //     $hasil=mysqli_query($kon,$sql);
    //     $data = mysqli_fetch_assoc($hasil);


    // }

    // //Cek apakah ada kiriman form dari method post
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $id=$_POST["id"];
    //     $jumlah_pembayaran=input($_POST["jumlah_pembayaran"]);
    //     $tanggal_pembayaran=input($_POST["tanggal_pembayaran"]);
    //     $jumlah_saldo=input($_POST["jumlah_saldo"]);

    //     //Query update data pada tabel saldo
    //     $sql="update saldo set
	// 		id='$id',
	// 		jumlah_pembayaran='$jumlah_pembayaran',
	// 		tanggal_pembayaran='$tanggal_pembayaran',
	// 		jumlah_saldo='$jumlah_saldo'";

    //     //Mengeksekusi atau menjalankan query diatas
    //     $hasil=mysqli_query($kon,$sql);

    //     //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    //     if ($hasil) {
    //         header("Location:index.php");
    //     }
    //     else {
    //         echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

    //     }
    
    // }

    ?>

    <body>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Update Data</span>
        </div>
        <div class="m-8 p-10 bg-white rounded-md shadow-xl">
            <form action="" method="POST">
                <label for="id">Akun ID</label>
                <input type="hidden" name="id" placeholder="1" required class="block border border-gray-700 rounded-sm p-1 w-[300px]" value="<?php echo $tampil['id']?>"> <br>
    
                <label for="jumlah_pembayaran">Jumlah Pembayaran (IDR):</label>
                <input type="number" name="jumlah_pembayaran" placeholder="10.000" step="0.01" required class="block border border-gray-700 rounded-sm p-1 w-[300px]" value="<?php echo $tampil['jumlah_pembayaran']?>"><br>
    
                <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                <input type="date" name="tanggal_pembayaran" placeholder="1/1/2024" required class="block border border-gray-700 rounded-sm p-1 w-[300px]" value="<?php echo $tampil['tanggal_pembayaran']?>"><br>
    
                <label for="jumlah_saldo">Jumlah Saldo (IDR):</label>
                <input type="number" name="jumlah_saldo" placeholder="2.000.000" step="0.01" required class="block border border-gray-700 rounded-sm p-1 w-[300px]" value="<?php echo $tampil['jumlah_saldo']?>"><br>
    
                <input type="submit" name="submit" value="Upload">
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
</div>
</body>
</html>