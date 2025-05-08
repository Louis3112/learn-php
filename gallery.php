<?php
include "services/database.php";       
session_start();                                              // memulai atau melanjutkan sesi jika ada
$files = glob('assets/*.{jpg,jpeg,png,gif}', GLOB_BRACE);     // mencari semua file secara global di folder assets yg memiliki ext ssesuai array
                                                              // GLOB_BRACE mencari banyak ext sekaligus
/*echo '<ul>';
foreach($files as $i){
    echo '<li>' . basename($i) . '</li>';
}
echo '</ul>';
*/

if(isset($_POST['delete'])){                                  // jika tombol hapus ditekan
    $file_name = $_POST["img_name"];                          // mengambil nama file dari form input
    unlink($file_name);                                       // menghapus file dari folder assets
    
    $username = $_SESSION["username"];                        // session adalah array
    $delete = "UPDATE users SET img = '' WHERE users.username = '$username'";
    $connect->query($delete);

    header("location:gallery.php");                           // redirect ke gallery
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>

<style>
    body{
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }
</style>

<body>
    <!-- connect ke layout/header -->
    <?php include "layout/header.html"?> 
    
    <h1 style="margin-top: 20px; margin-bottom: 10px;">Welcome to Gallery</h1>
    
    <?php foreach ($files as $img):?>                               <!-- Looping utk menampilkan gambar -->
        <img src="<?= $img?>" width = "200px" alt="">           
        <p> <?= basename($img) ?></p>                               <!-- Menampilkan nama file -->
        <form action="gallery.php" method=POST>
            <input type="hidden" name="img_name" value="<?= $img?>">   <!-- Menyimpan nama file (berupa assets/nama-file.ext) -->
            <button type="submit" name="delete">Delete</button>        <!-- Yang apabila ditekan akan menghapus foto tersebut -->
        </form>
    <?php endforeach ?>
    
    <br>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut libero ullam exercitationem repellendus. Quia amet, atque maiores harum dicta ullam a quas corrupti doloremque reiciendis perferendis error adipisci earum debitis tempore iste voluptate hic ad. Nisi eligendi aspernatur beatae facere adipisci sunt modi asperiores, ex deleniti nulla, fugit inventore quod aliquam tempore quae iure fugiat ipsam neque dicta accusantium explicabo voluptates quas saepe! Suscipit quasi repellat commodi odit impedit, consequuntur sunt doloribus optio adipisci necessitatibus dolorem quod asperiores, minima magni rerum ad ea. Expedita vitae veritatis totam harum, nihil dolore? Dolore quia consequatur recusandae esse cum omnis consequuntur non sapiente?</p>

    <!-- connect ke layout/footer -->
    <?php include "layout/footer.html"?> 
</body>
</html>