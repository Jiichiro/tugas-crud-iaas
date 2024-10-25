<?php
function isi() {
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

    $html = <<<HTML
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
HTML;

    if ($pemasukan):
        foreach ($pemasukan as $row):
            $html .= <<<HTML
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{$row['tanggal']}</td>
                    <td class="border border-gray-300 px-4 py-2">
HTML;
            $html .= number_format($row['jumlah'], 0, ',', '.');
            $html .= <<<HTML
                    </td>
                </tr>
HTML;
        endforeach;
    else: 
        $html .= <<<HTML
            <tr>
                <td class="border border-gray-300 px-4 py-2" colspan="2">Tidak ada data pemasukan untuk bulan ini.</td>
            </tr>
HTML;
    endif;

    $html .= <<<HTML
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
HTML;

    if ($pengeluaran):
        foreach ($pengeluaran as $row):
            $html .= <<<HTML
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{$row['tanggal']}</td>
                    <td class="border border-gray-300 px-4 py-2">
HTML;
            $html .= number_format($row['jumlah'], 0, ',', '.');
            $html .= <<<HTML
                    </td>
                </tr>
HTML;
        endforeach;
    else:
        $html .= <<<HTML
            <tr>
                <td class="border border-gray-300 px-4 py-2" colspan="2">Tidak ada data pengeluaran untuk bulan ini.</td>
            </tr>
HTML;
    endif;

    $html .= <<<HTML
                </tbody>
            </table>
        </div>
HTML;

    return $html;
}

include 'main.php';
echo main("Kas Kelas", isi());
?>