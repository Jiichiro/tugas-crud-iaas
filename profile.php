<?php
// Asumsikan data profil tersedia dalam variabel $profile
$profile = [
    'name' => 'John Doe',
    'age' => 30,
    'email' => 'johndoe@example.com',
    'bio' => 'Seorang pengembang web yang bersemangat.'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .profile-info {
            margin-bottom: 15px;
        }
        .profile-info strong {
            display: inline-block;
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Detail Profil</h1>
        <div class="profile-info">
            <strong>Nama:</strong> <?php echo htmlspecialchars($profile['name']); ?>
        </div>
        <div class="profile-info">
            <strong>Usia:</strong> <?php echo htmlspecialchars($profile['age']); ?> tahun
        </div>
        <div class="profile-info">
            <strong>Email:</strong> <?php echo htmlspecialchars($profile['email']); ?>
        </div>
        <div class="profile-info">
            <strong>Bio:</strong> <?php echo htmlspecialchars($profile['bio']); ?>
        </div>
    </div>
</body>
</html>