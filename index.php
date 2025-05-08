<?php
session_start();                         // memulai atau melanjutkan sesi jika ada

if(isset($_SESSION["is_login"])){
    header("location:dashboard.php");    // redirect halaman dashboard
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar PHP</title>
</head>

<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        text-align : center;
    }
    
    h5 a{
        text-decoration:none;
        color:rgb(198, 11, 11);
        transition: all 0.2s ease-in-out;
    }

    h5 a:hover{
        text-decoration:none;
        color:rgb(11, 120, 198);
    }

    .footer{
        position:absolute;
        bottom: 0;
        width: 100%;
    }
</style>

<body>
    <!-- connect ke layout/header -->
    <?php include "layout/header.html"?> 
    
    <h1 style="margin-top: 20px; margin-bottom: 10px;">Welcome!</h1>
    <h5 style="margin: 10px">Have any account? <a href="login.php">Come on in</a></h3>
    <h5 style="margin: 10px">Don't have any account? <a href="register.php">Create one!</a></h3>
    
    <br>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut libero ullam exercitationem repellendus. Quia amet, atque maiores harum dicta ullam a quas corrupti doloremque reiciendis perferendis error adipisci earum debitis tempore iste voluptate hic ad. Nisi eligendi aspernatur beatae facere adipisci sunt modi asperiores, ex deleniti nulla, fugit inventore quod aliquam tempore quae iure fugiat ipsam neque dicta accusantium explicabo voluptates quas saepe! Suscipit quasi repellat commodi odit impedit, consequuntur sunt doloribus optio adipisci necessitatibus dolorem quod asperiores, minima magni rerum ad ea. Expedita vitae veritatis totam harum, nihil dolore? Dolore quia consequatur recusandae esse cum omnis consequuntur non sapiente?</p>

    <!-- connect ke layout/footer -->
    <div class="footer">
        <?php include "layout/footer.html"?> 
    </div>
</body>