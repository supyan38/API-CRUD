<?php
include '../config/koneksi.php';

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil data dari JSON atau Form
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    $data = $_POST;
}

// Ambil nilai dari input
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

// Update data dengan prepared statement (lebih aman)
$query = "UPDATE mahasiswa SET nama=?, nim=?, prodi=?, email=? WHERE id=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssi", $nama, $nim, $prodi, $email, $id);

if ($stmt->execute()) {
    if (strpos($_SERVER["HTTP_USER_AGENT"], "Mozilla") !== false) {
        // 🔄 Jika akses dari browser, langsung redirect ke indeks.php
        header("Location: http://localhost/Latihan_CRUD/API-CRUD/latihan_CRUD/readapi/layout/indeks.php");
        exit();
    }
    // ✅ Jika akses dari Postman, kirim JSON response
    echo json_encode(["status" => "success", "message" => "Data berhasil diperbarui"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal memperbarui data: " . $stmt->error]);
}
?>
