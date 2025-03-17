<?php
include '../config/koneksi.php';

if (isset($_POST['tambah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];

    $query = "INSERT INTO mahasiswa (id, nama, nim, prodi, email) VALUES ('$id', '$nama', '$nim', '$prodi', '$email')";
    if ($conn->query($query) === TRUE) {
        header("Location: ../readapi/layout/indeks.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>