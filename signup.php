<?php
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
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Hash password dengan MD5
        $hashedPassword = md5($password);

        // Menyimpan data ke database
        $stmt = $pdo->prepare("INSERT INTO akun (username, password) VALUES (:username, :password)");
        $stmt->execute([
            'username' => $username,
            'password' => $hashedPassword
        ]);

        echo "Pendaftaran berhasil! Anda sekarang dapat masuk.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        
        <input type="submit" value="Daftar">
    </form>
</body>
</html>
