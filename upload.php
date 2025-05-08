<?php
include "services/database.php";
session_start();

if(isset($_POST["upload"])){                                        // jika tombol upload ditekan
    $file = $_FILES["img"];                                         // mengambil data upload img
    $file_name = basename($file["name"]);                           // mengambil nama asli file
    $username = $_SESSION["username"];                              // mengambil data username karena yg upload adalah username tersebut

    $allowed = ['jpg', 'png', 'jpeg', 'gif'];                            // mengambil data username karena yg upload adalah username tersebut
    $extfile = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));   // mengambil ext file dan mengubahnya menjadi huruf kecil
    
    if(in_array($extfile,$allowed)){                                    // mengecek apakah ext file sesuai dengan yg di array
        $count_files = glob('assets/*.{jpg,jpeg,png,gif}', GLOB_BRACE);    // melakukan pencarian secara global di folder assets yg memiliki ext ssesuai array
        $counter = count($count_files) + 1;                              // menghitung ada berapa banyak file
        $new_name = $counter . '.' . $extfile;                           // melakukan rename
        $destination = 'assets/' . $new_name;                            // menentukan destinasi penyimpanan dan penamaan file 

        if(move_uploaded_file($file['tmp_name'],$destination)){     // memindahkan file secara global di folder assets yg memiliki ext ssesuai array   
            echo "Image post success";
            $upload = "UPDATE users SET img = '$new_name' WHERE users.username = '$username'";       // mengupdate ke query sql
            $connect->query($upload);
        }
        else{
            echo "Image post failed";
        }
    } else {
        echo "Make sure the file are in jpg, png, jpeg, gif";
    }
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

    .upload-container input[type="file"] {
        padding: 15px;
        border: 2px solid rgb(198, 11, 11) ;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .upload-container input[type="file"]:hover {
        border: 2px solid rgb(107, 3, 3);
        background-color:rgb(251, 85, 85) ;
    }

    .upload-container button {
        padding: 15px 20px;
        border: none;
        background-color:rgb(198, 11, 11);
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .upload-container button:hover {
        background-color:rgb(26, 195, 0);
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
    
    <h1 style="margin-top: 20px; margin-bottom: 10px;">Upload!</h1>

    <div class="upload-container">
        <form action="upload.php" method="POST" enctype= "multipart/form-data"> <!-- enctype ditambahkan agar form dapat mengupload file -->
            <p>Input image here</p>
                <input type="file" name="img">
            <button type="submit" name="upload">Upload</button>
        </form>
    </div>
    
    <br>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut libero ullam exercitationem repellendus. Quia amet, atque maiores harum dicta ullam a quas corrupti doloremque reiciendis perferendis error adipisci earum debitis tempore iste voluptate hic ad. Nisi eligendi aspernatur beatae facere adipisci sunt modi asperiores, ex deleniti nulla, fugit inventore quod aliquam tempore quae iure fugiat ipsam neque dicta accusantium explicabo voluptates quas saepe! Suscipit quasi repellat commodi odit impedit, consequuntur sunt doloribus optio adipisci necessitatibus dolorem quod asperiores, minima magni rerum ad ea. Expedita vitae veritatis totam harum, nihil dolore? Dolore quia consequatur recusandae esse cum omnis consequuntur non sapiente?</p>

    <!-- connect ke layout/footer -->
    <div class="footer">
        <?php include "layout/footer.html"?> 
    </div>
</body>
</html>