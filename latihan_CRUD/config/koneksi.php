<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_mahasiswa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("koneksi gagal: " . $conn->connect_error);
} else {
    
}

?>

