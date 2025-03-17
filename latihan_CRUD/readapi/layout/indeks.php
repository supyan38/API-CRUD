<?php
// Koneksi ke database
include '../../config/koneksi.php';

// Ambil data dari database
$query = "SELECT * FROM mahasiswa";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Data Mahasiswa</h2>
        <!-- Tombol untuk membuka modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMahasiswa">
            Tambah Mahasiswa
        </button>

        <!-- Modal Tambah Mahasiswa -->
        <div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahMahasiswaLabel">Tambah Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Tambah Mahasiswa -->
                        <form action="../../api/api_tambah.php" method="POST">
                            <div class="mb-3">
                                <label for="id" class="form-label">Id</label>
                                <input type="text" class="form-control" id="id" name="id" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" required>
                            </div>
                            <div class="mb-3">
                                <label for="prodi" class="form-label">Prodi</label>
                                <input type="text" class="form-control" id="prodi" name="prodi" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-12">
                                <input type="submit" name="tambah" value="Tambah Data" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['nim']; ?></td>
                        <td><?= $row['prodi']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#editModal"
                                data-id="<?= $row['id']; ?>" data-nama="<?= $row['nama']; ?>" data-nim="<?= $row['nim']; ?>"
                                data-prodi="<?= $row['prodi']; ?>" data-email="<?= $row['email']; ?>">
                                Edit
                            </button>

                            <a href="../../api/api_hapus.php?hapus=<?= $row['id']; ?>" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST" action="/../api/api_edit.php">
                            <input type="hidden" id="edit-id" name="id">
                            <div class="mb-3">
                                <label for="edit-nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="edit-nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="edit-nim" name="nim" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-prodi" class="form-label">Prodi</label>
                                <input type="text" class="form-control" id="edit-prodi" name="prodi" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit-email" name="email" required>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk Edit Data
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('edit-id').value = this.getAttribute('data-id');
                document.getElementById('edit-nama').value = this.getAttribute('data-nama');
                document.getElementById('edit-nim').value = this.getAttribute('data-nim');
                document.getElementById('edit-prodi').value = this.getAttribute('data-prodi');
                document.getElementById('edit-email').value = this.getAttribute('data-email');
            });
        });
    </script>
</body>
</html>