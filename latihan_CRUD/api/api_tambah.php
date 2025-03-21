<?php
include '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    // Jika data dikirim dari form HTML
    if (!$data) {
        $data = $_POST;
    }

    $id = $data['id'] ?? null;
    $nama = $data['nama'] ?? null;
    $nim = $data['nim'] ?? null;
    $prodi = $data['prodi'] ?? null;
    $email = $data['email'] ?? null;

    // Validasi input
    if (!$id || !$nama || !$nim || !$prodi || !$email) {
        echo json_encode(["status" => "error", "message" => "Semua field harus diisi!"]);
        exit();
    }

    // Cek apakah ID sudah ada di database
    $checkQuery = "SELECT id FROM mahasiswa WHERE id = '$id'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "ID sudah ada, gunakan ID lain!"]);
        exit();
    }

    // Lakukan insert data baru
    $query = "INSERT INTO mahasiswa (id, nama, nim, prodi, email) VALUES ('$id', '$nama', '$nim', '$prodi', '$email')";
    if ($conn->query($query) === TRUE) {
        if (strpos($_SERVER["HTTP_USER_AGENT"], "Mozilla") !== false) {
            header("Location: http://localhost/Latihan_CRUD/API-CRUD/latihan_CRUD/readapi/layout/indeks.php");
            exit();
        }
        echo json_encode(["status" => "success", "message" => "Data berhasil ditambahkan"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menambahkan data: " . $conn->error]);
    }
}
?>
