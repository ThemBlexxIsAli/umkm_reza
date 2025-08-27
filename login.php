<?php
include "koneksi.php";
session_start();
$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $login = mysqli_query($conn, $query);

        if (mysqli_num_rows($login) > 0) {
            $data = mysqli_fetch_assoc($login);
            if ($data['role'] == "admin") {
                $_SESSION['admin'] = $username;
                header("Location: index2.php");
                exit;
            } elseif ($data['role'] == "users") {
                $_SESSION['user'] = $data['username'];
                $_SESSION['nama'] = $data['nama'];
                $_SESSION['id_user'] = $data['id'];
                header("Location: index.php");
                exit;
            }
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Harap isi semua kolom!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Aplikasi</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #00c853, #b2ff59);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #00c853;
        }
        .form-group {
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #00e676;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #00c853;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .register {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
        .register a {
            color: #0835ffff;
            text-decoration: none;
            font-weight: bold;
        }
        .register a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Login</h1>
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required autofocus>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="login">Masuk</button>
    </form>
    <div class="register">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
    </div>
</div>
</body>
</html>
