<?php
include "koneksi.php";
session_start();
if(isset($_POST['daftar'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $daftar = mysqli_query(
        $koneksi,
        "insert into users ('$username','$password')"
    );
    if(mysqli_num_rows($login) > 0){
        $data = mysqli_fetch_assoc($login);
        if($data['role'] == "admin"){
            $_SESSION['admin'] = $username;
            header("location: dashboard.php");
        }elseif($data['role'] == "user"){
            $_SESSION['user'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['id_user'] = $data['id'];
            header("location: index.php");
        }
    }else{
        echo "username dan password salah";
        header("location: login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>daftar</title>
</head>
<body>
    <h1>daftar</h1>
    <div class="form">
        <form method="POST">
            <input type="text" name="username" placeholder="username"><br>
            <input type="text" name="password" placeholder="password"><br>
            <button type="submit" name="daftar">Masuk</button>
        </form>
    </div>
</body>
</html>