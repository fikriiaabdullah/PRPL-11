<?php 

$server = "localhost";
$username = "root";
$password = "";
$dbname = "db_users";

$koneksi = mysqli_connect($server, $username, $password, $dbname) or die("Koneksi ke database gagal");

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>