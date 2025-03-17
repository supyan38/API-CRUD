<?php
include '../config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $query = "DELETE FROM mahasiswa WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        header("Location: ../readapi/layout/indeks.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>