<?php
include "services/database.php";
session_start();                                               // memulai atau melanjutkan sesi jika ada
$mes = " ";                                            
if(isset($_POST["check-username"])){                           // jika tombol check availability ditekan     
    $new_username = $_POST["username1"];                       // menyimpan data new_username
    $check = "SELECT * FROM users WHERE username = '$new_username'";     // query sql
    $result = $connect->query($check);                         // query dijalankan pake koneksi $connect
    
    if($result->num_rows > 0){                                 // jika tabel sql memiliki lebih dari 1
        $mes = "Username is not available";                    
        $_SESSION["username_available"] = false;               // username tidak available
    } else {
        $mes = "Username is available";                        
        $_SESSION["new_username"] = $new_username;             // var new_username disimpan agar apabila dilakukan refresh tidak hilang
        $_SESSION["username_available"] = true;                // var username available disimpan agar apabila dilakukan refresh tidak hilang
    }
}

if(isset($_POST["change-username"])){                          // jika tombol change username ditekan
    if(isset($_SESSION["username_available"]) && $_SESSION["username_available"] === true) {       // memeriksa apakah sudah melakukan check availability
        $old_username = $_SESSION["username"];
        $new_username = $_SESSION["new_username"];             // ambil dari session yang disimpan saat check availability 

        $change = "UPDATE users SET username = '$new_username' WHERE username = '$old_username'";      // query sql
        if ($connect->query($change)) {                        // query dijalankan pake koneksi $connect
            $_SESSION["username"] = $new_username;             // update username session ke username baru 
            unset($_SESSION["username_available"]);            // menghapus session username_available karena sudah tidak dibutuhkan
            unset($_SESSION["new_username"]);                  // menghapus session new_username karena sudah tidak dibutuhkan
            $mes = "Username has been changed successfully";
        } 
        else {
            $mes = "Username changed failed";
        }
    } 
    else {
        $mes = "Please check username availabaility";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Username</title>
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

    .change-user-card {
        margin-top: 30px;
        padding: 20px 40px;
        
        border : 3px solid rgb(198, 11, 11);
        border-radius: 20px;
        background-color: white;
        width: 100%;
        max-width: 400px;
    }

    .change-user-card h2 {
      text-align: center;
      color:rgb(198, 11, 11);
    }

    .change-user-card p {
        text-align: left;
    }

    .change-user-card input[type="text"],
    .change-user-card input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid;
      border-radius: 10px;
    }

    .change-user-card button {
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
        <div class="change-user-card">
            <p style="text-align:center;"><i><?=$mes?></i></p>
            <h2>Change Username</h2>
            <form action="changeuser.php" method="POST">
                <p>New Username</p>
                    <input type="text" name="username1" required>
                <p>Confirm New Username</p>
                    <input type="text" name="username2" required>
                <div>
                    <button type="submit" name="check-username">Check Availabilty</button>
                    <button type="submit" name="change-username">Change Password</button>
                </div>
            </form>
        </div>
    </main>

    <div class="footer">
        <?php include "layout/footer.html"?> 
    </div>

</body>
</html>  