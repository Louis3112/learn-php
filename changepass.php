<?php
include "services/database.php";
session_start();
$mes = " ";
if(isset($_POST["change-pass"])){                             // jika tombol change password ditekan
    $pass1 = $_POST["pass1"];                                 // mengambil data pass1 dan pass2
    $pass2 = $_POST["pass2"]; 
    $username = $_SESSION["username"];                        // mengambil session username

    $hashnewpass = hash('sha256',$pass1);

    if($pass1 == $pass2){
        $changepass = "UPDATE users SET password = '$hashnewpass' WHERE username = '$username'";         // query sql
        if($connect->query($changepass)){                    // query dijalankan pake koneksi $connect
            $mes = "Password has been changed successfully";
        }
        else{
            $mes = "Password change failed";
        }
    }
    else{
        $mes = "Password is not same";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

    .change-pass-card {
        margin-top: 30px;
        padding: 20px 40px;
        
        border : 3px solid rgb(198, 11, 11);
        border-radius: 20px;
        background-color: white;
        width: 100%;
        max-width: 400px;
    }

    .change-pass-card h2 {
      text-align: center;
      color:rgb(198, 11, 11);
    }

    .change-pass-card p {
        text-align: left;
    }

    .change-pass-card input[type="text"],
    .change-pass-card input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid;
      border-radius: 10px;
    }

    .change-pass-card button {
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
        <div class="change-pass-card">
            <p style="text-align:center;"><i><?=$mes?></i></p>
            <h2>Change Password</h2>
            <form action="changepass.php" method="POST">
                <p>New Password</p>
                    <input type="password" name="pass1" required>
                <p>Confirm New Password</p>
                    <input type="password" name="pass2" required>
                <button type="submit" name="change-pass">Change Password</button>
            </form>
        </div>
    </main>

    <div class="footer">
        <?php include "layout/footer.html"?> 
    </div>
</body>
</html>