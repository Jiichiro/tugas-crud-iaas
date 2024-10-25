<?php
include "koneksi.php";

// $user_id = $_SESSION['user_id'];
$result = $kon->query("SELECT * FROM saldo WHERE akun_id");

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Cek Saldo</title>
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
            <span class="text">Cek Saldo</span>
        </div>
        <main class="main-content">
            <div class="p-10 m-8 bg-white rounded-lg shadow-xl">
                <table class="min-w-full border-collapse border border-gray-200">
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Jumlah Pembayaran</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Jumlah Saldo</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-left"><?php echo $row['id']; ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-left"><?php echo $row['jumlah_pembayaran']; ?></td>
                            <td class="border border-gray-300 px-4 py-2 text-left"><?php echo $row['jumlah_saldo']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </main>
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