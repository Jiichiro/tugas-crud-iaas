<?php function isi() {
include "koneksi.php";
try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
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

        echo <<<HTML
            <script>
                alert("data berhasil ditambahkan")
            </script>
        HTML;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$html = <<<HTML
        <div class="m-8 p-10 bg-white rounded-md shadow-xl">
            <form action="" method="POST">
                <label for="akun_id">Akun ID</label>
                <input type="number" name="akun_id" placeholder="1" required class="block border border-gray-700 rounded-sm p-1 w-[300px]"><br>
    
                <label for="jumlah_pembayaran">Jumlah Pembayaran (IDR):</label>
                <input type="number" name="jumlah_pembayaran" placeholder="10.000" step="0.01" required class="block border border-gray-700 rounded-sm p-1 w-[300px]"><br>
    
                <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                <input type="date" name="tanggal_pembayaran" placeholder="1/1/2024" required class="block border border-gray-700 rounded-sm p-1 w-[300px]"><br>
    
                <label for="jumlah_saldo">Jumlah Saldo (IDR):</label>
                <input type="number" name="jumlah_saldo" placeholder="2.000.000" step="0.01" required class="block border border-gray-700 rounded-sm p-1 w-[300px]"><br>
    
                <input type="submit" value="Upload" class="bg-transparent rounded border-2 border-blue-700 arrow-right px-4 py-2 font-bold hover:text-white hover:bg-blue-700 transition duration-500 ease-in-out cursor-pointer">
            </form>
        </div>
HTML;
return $html;
}
include 'main.php';
echo main("Upload Data Saldo", isi())
?>
