<?php function isi() {
    include "koneksi.php";

    // Query untuk mendapatkan data saldo
    $result = $kon->query("SELECT * FROM saldo WHERE akun_id"); // Tambahkan kondisi WHERE jika diperlukan

    // Awal HTML
    $html = <<<HTML
    <div class="p-10 m-8 bg-white rounded-lg shadow-xl">
        <table class="min-w-full border-collapse border border-gray-200">
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Jumlah Pembayaran</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Terakhir Bayar</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Jumlah Saldo</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Aksi</th>
            </tr>
HTML;

    // Loop untuk menampilkan setiap baris data
    while ($row = $result->fetch_assoc()) {
        $html .= <<<HTML
        <tr>
            <td class="border border-gray-300 px-4 py-2 text-left">{$row['id']}</td>
            <td class="border border-gray-300 px-4 py-2 text-left">{$row['jumlah_pembayaran']}</td>
            <td class="border border-gray-300 px-4 py-2 text-left">{$row['tanggal_pembayaran']}</td>
            <td class="border border-gray-300 px-4 py-2 text-left">{$row['jumlah_saldo']}</td>
            <td class="">
                <a href="update.php?aksi=update&id={$row['id']}" class="bg-transparent hover:bg-yellow-500 text-black-700 font-semibold hover:text-black py-2 px-2 border border-yellow-500 hover:border-transparent rounded">Update</a>
                <a href="delete.php?aksi=delete&id={$row['id']}" onclick="return confirm('yakin ingin menghapus data ini')" class="bg-transparent hover:bg-red-500 text-black-700 font-semibold hover:text-white py-2 px-2 border border-red-500 hover:border-transparent rounded">Delete</a>
            </td>
        </tr>
HTML;
    }
    $html .= "</table></div>";
    return $html;
}
include 'main.php';
echo main("Edit Data", isi());
?>
