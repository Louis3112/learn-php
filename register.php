<?php
include "services/database.php"; 
session_start();                           // memulai atau melanjutkan sesi jika ada

if(isset($_SESSION["is_login"])){
    header("location:dashboard.php");      // redirect halaman dashboard
}

if(isset($_POST["register"])){             // jika tombol login ditekan
    $username = $_POST["username"];        // mengambil data username dan password
    $password = $_POST["password"];

    $hashpassword = hash("sha256", $password);    // memformat password menjadi hash

    $register = "INSERT INTO users (username, password) VALUES ('$username', '$hashpassword')";     // query SQL

    if($connect->query($register)){        // query dijalankan 
        echo "Register Success";
    }
    else{
        echo "Register Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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

    .register-card {
        margin-top: 30px;
        padding: 20px 40px;      
        border : 3px solid rgb(198, 11, 11);
        border-radius: 20px;
        background-color: white;
        width: 100%;
        max-width: 400px;
    }

    .register-card h2 {
      text-align: center;
      color:rgb(198, 11, 11);
    }

    .register-card p {
        text-align: left;
    }

    .register-card input[type="text"],
    .register-card input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid;
      border-radius: 10px;
    }

    .register-card button {
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
        <div class="register-card">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <p>Create Username</p>
                    <input type="text" name="username" required>
                <p>Create Password</p>
                    <input type="password" name="password" required>
                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </main>

    <div class="footer">
        <?php include "layout/footer.html"?> 
    </div>
</body>
</html>