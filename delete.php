<?php
include "koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($kon, "DELETE FROM `saldo` WHERE id= $id");
if (mysqli_affected_rows($kon) > 0) {
    echo <<<HTML
    <script>
    alert('DATA BERHASIL DIHAPUS');
    document.location.href='edit_data.php';
</script>
HTML;
}
?>