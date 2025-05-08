<?php
include "services/database.php";       
session_start();                                // memulai atau melanjutkan sesi jika ada

if(isset($_POST["logout"])){
    $_SESSION["is_login"] = false;          // session login false, jadi tidak login
    session_unset();                        // menghapus semua var $_SESSION
    session_destroy();                      // menghapus sesi aktif dari server

    header("location:index.php");           // direct ke index.php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<style>
    body{
        margin:0;
        font-family:Arial, Helvetica, sans-serif;
        text-align:center;
    }

    button{
        border:none;
        padding: 12px;
        text-align:center;
        border-radius: 20px;
        background-color: white;
        cursor:pointer;
        transition: all 0.3s ease-in-out;
        margin-left: 10px;
    }

    button:hover{
        color: white;
        background-color:rgb(198, 11, 11);
    }

    .footer{
        position:absolute;
        bottom: 0;
        width: 100%;
    }
</style>
<body>
    <?php include "layout/header.html"?>

    <h1>Welcome, <?= ($_SESSION["username"]) ?></b></h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit quas sed error pariatur, officia expedita asperiores molestiae. Culpa delectus dolores suscipit, reprehenderit eaque est sed molestias laudantium minima dolorem dolore in id autem porro optio maiores labore sint, ea sunt at reiciendis exercitationem atque. Iure facere laborum veniam aliquam blanditiis, excepturi ratione ex neque quod rem voluptatibus nostrum, hic aspernatur maxime voluptatem reiciendis consectetur temporibus aut animi unde adipisci quo? Alias esse voluptatum tempore consequatur deleniti sint fugiat maiores delectus voluptas suscipit corrupti consectetur error voluptatibus laudantium, nihil quia. Tempora ullam sequi magnam error officiis eum id iste quia omnis?</p>
    
    <form action="dashboard.php" method="POST">
        <button type="submit" name="logout">Logout</button>
        <button type="submit" name="change-user">Ganti Username</button>
        <button type="submit" name="change-pass">Ganti Password</button>
        <button type="submit" name="delete">Hapus Akun</button>
        <button type="upload" name="upload">Upload</button>
        <button type="upload" name="gallery">Gallery</button>
    </form>

    <div class="footer">
        <?php include "layout/footer.html"?> 
    </div>
</body>
</html>