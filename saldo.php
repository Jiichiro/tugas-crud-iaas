<?php function isi()
{
    include "koneksi.php";

    // $user_id = $_SESSION['user_id'];

    $result = $kon->query("SELECT * FROM saldo WHERE akun_id");
    $html = <<<HTML
        <div class="p-10 m-8 bg-white rounded-lg shadow-xl">
            <table class="min-w-full border-collapse border border-gray-200">
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Jumlah Pembayaran</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Terakhir Bayar</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Jumlah Saldo</th>
                </tr>
HTML;
    while ($row = $result->fetch_assoc()) {
        $html .= <<<HTML
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-left">{$row['id']}</td>
                        <td class="border border-gray-300 px-4 py-2 text-left">{$row['jumlah_pembayaran']}</td>
                        <td class="border border-gray-300 px-4 py-2 text-left">{$row['tanggal_pembayaran']}</td>
                        <td class="border border-gray-300 px-4 py-2 text-left">{$row['jumlah_saldo']}</td>
                    </tr>
HTML;
    }
    $html .= <<<HTML
            </table>
        </div>
HTML;
    return $html;
}
include "main.php";
echo main("Cek Saldo", isi());

?>