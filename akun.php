<?php
session_start();
// Simulasi data akun
$nama = "";
$username = "";
$email = "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f6eee3, #fdfaf6);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding-top: 60px;
    }

    .profile-card {
      background: #fff;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      text-align: center;
      transition: 0.3s ease;
    }

    .profile-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .profile-img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      border: 4px solid #87a96b;
      margin-bottom: 20px;
    }

    .profile-card h3 {
      font-weight: bold;
      color: #5a3e2b;
    }

    .profile-card p {
      font-size: 16px;
      margin-bottom: 10px;
      color: #333;
    }

    .profile-card i {
      color: #87a96b;
      margin-right: 10px;
    }

    .btn-custom {
      background-color: #87a96b;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 8px;
      transition: background-color 0.3s;
    }

    .btn-custom:hover {
      background-color: #6e8b5b;
    }

    .btn-secondary {
      border-radius: 8px;
    }

    .btn-group {
      gap: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="profile-card">
        <img src="profil.jpg" alt="Foto Profil" class="profile-img" onerror="this.src='https://via.placeholder.com/120'">
        <h3><?= $nama ?></h3>
        <hr>
        <p><i class="bi bi-person-fill"></i><strong>Username:</strong> <?= $username ?></p>
        <p><i class="bi bi-envelope-fill"></i><strong>Email:</strong> <?= $email ?></p>

        <div class="d-flex justify-content-center btn-group mt-4">
          <a href="edit_akun.php" class="btn btn-custom"><i class="bi bi-pencil-square"></i> Edit Akun</a>
          <a href="index.php" class="btn btn-secondary"><i class="bi bi-house-fill"></i> Beranda</a>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
