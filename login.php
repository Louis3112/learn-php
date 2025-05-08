<?php 
include "services/database.php"; 
session_start();                                  // memulai atau melanjutkan sesi jika ada

if(isset($_SESSION["is_login"])){                 
    header("location:dashboard.php");             // redirect halaman dashboard.php
}

if(isset($_POST["login"])){                       // jika tombol login ditekan
    $username = $_POST["username"];               // mengambil data username dan password
    $password = $_POST["password"];
    $hashpassword = hash("sha256", $password);    // memformat password menjadi hash
    
    $login = "SELECT * FROM users WHERE username='$username' AND password='$hashpassword'";    // query SQL

    $result = $connect->query($login);      // query dijalankan pake koneksi $connect

    if($result->num_rows > 0){              // jika tabel sql memiliki lebih dari 1
        $table = $result->fetch_assoc();    // mengambil 1 baris dari query SQL dlm bentuk assoc array
            /*
                $table = [
                    username = user1
                    password = pass1
                ]
            */

        $_SESSION["username"] = $table["username"];   // menyimpan username dari tabel sql ke username session
        $_SESSION["is_login"] = true;                 // session login is true

        header("location:dashboard.php");             // direct halaman dashboard.php
    } else {
        echo "Login Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<style>
    * {
        box-sizing:border-box;
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        text-align : center;
        display: flex;
        flex-direction: column;
    }
    
    main {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        margin-top: 30px;
        padding: 20px 40px;
        
        border : 3px solid rgb(198, 11, 11);
        border-radius: 20px;
        background-color: white;
        width: 100%;
        max-width: 400px;
    }

    .login-card h2 {
      text-align: center;
      color:rgb(198, 11, 11);
    }

    .login-card p {
        text-align: left;
    }

    .login-card input[type="text"],
    .login-card input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid;
      border-radius: 10px;
    }

    .login-card button {
      width: 100%;
      margin-top: 10px;
      padding: 12px;
      border: none;
      border-radius: 10px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      background-color: rgb(198, 11, 11);
    }

    .footer{
        position:absolute;
        bottom: 0;
        width: 100%;
    }
</style>

<body>
    <?php include "layout/header.html"?>

    <main>
        <div class="login-card">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <p>Username</p>
                    <input type="text" name="username">
                <p>Password</p>
                    <input type="password" name="password">
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </main>

    <div class="footer">
        <?php include "layout/footer.html"?> 
    </div>
</body>
</html>