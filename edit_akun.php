<?php
session_start();
// Ambil data user dari database jika perlu
$nama = "";
$email = "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Akun</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #fdfaf6;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .edit-container {
      max-width: 500px;
      background-color: #ffffff;
      margin: 60px auto;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
    }

    .form-label {
      font-weight: 600;
      color: #5a3e2b;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-save {
      background-color: #87a96b;
      border: none;
      color: white;
      font-weight: 500;
      border-radius: 10px;
    }

    .btn-save:hover {
      background-color: #6e8b5b;
    }

    h2 {
      text-align: center;
      color: #5a3e2b;
      font-weight: bold;
      margin-bottom: 25px;
    }

    .input-group-text {
      background-color: #e8d9c4;
      border: none;
      color: #5a3e2b;
    }
  </style>
</head>
<body>

  <div class="edit-container">
    <h2><i class="bi bi-pencil-square"></i> Edit Akun</h2>
    <form method="post" action="proses_edit_akun.php">
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          <input type="text" class="form-control" name="nama" value="<?= $nama ?>" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" class="form-control" name="email" value="<?= $email ?>" required>
        </div>
      </div>

      <button type="submit" class="btn btn-save w-100 mt-3">
        <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
      </button>
    </form>
  </div>

</body>
</html>
