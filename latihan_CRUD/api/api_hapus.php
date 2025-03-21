<?php
include '../config/koneksi.php';

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = null;


if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'] ?? null;
} elseif (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
}


if (!$id) {
    die("ID tidak ditemukan!");
}


$checkQuery = "SELECT id FROM mahasiswa WHERE id = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data tidak ditemukan!");
}

$query = "DELETE FROM mahasiswa WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
        // ✅ Jika request dari Postman/API, kirim response JSON
        echo json_encode(["status" => "success", "message" => "Data berhasil dihapus"]);
    } else {
        // 🔄 Jika request dari browser, redirect ke indeks.php
        header("Location: http://localhost/Latihan_CRUD/API-CRUD/latihan_CRUD/readapi/layout/indeks.php");
        exit();
    }
} else {
    die("Gagal menghapus data: " . $stmt->error);
}
?>
