<?php

$hostname = "localhost"; // database ada di localhost
$username = "root";      // menggunakkan user root utk login ke mysql
$password = "";          // nanti akan ada password
$database = "belajar";   // menggunakkan database "belajar"

$connect = mysqli_connect($hostname, $username, $password, $database); 
?>
