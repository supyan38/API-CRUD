<?php
include '../config/koneksi.php';

// Query untuk mengambil semua data mahasiswa
$query = "SELECT * FROM mahasiswa";
$result = $conn->query($query);

// Cek apakah data ditemukan
if ($result->num_rows > 0) {
    $mahasiswa = [];
    
    while ($row = $result->fetch_assoc()) {
        $mahasiswa[] = $row;
    }
    
    echo json_encode(["status" => "success", "data" => $mahasiswa], JSON_PRETTY_PRINT);
} else {
    echo json_encode(["status" => "error", "message" => "Tidak ada data ditemukan"]);
}
?>
