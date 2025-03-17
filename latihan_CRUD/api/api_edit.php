<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];

    $query = "UPDATE mahasiswa SET nama='$nama', nim='$nim', prodi='$prodi', email='$email' WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        header("Location: ../readapi/layout/indeks.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>