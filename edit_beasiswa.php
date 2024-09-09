<?php
include 'func/starttime.php'; 
include 'db/koneksi.php';

 // Dapatkan ID dari URL
$editId = $connection->real_escape_string($_GET['id']);

// Ambil data user berdasarkan ID
$query = "SELECT * FROM beasiswa WHERE id = '$editId'";
$result = $connection->query($query);

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Beasiswa - Pilihan Beasiswa</title>
    <?php include 'layout/head.php'; ?>
</head>

<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="container mt-3">
        <div class="text-center">
            <h2>Edit Data Beasiswa</h2>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    Edit Data Beasiswa
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="number" class="form-control" id="nim" name="nim"
                                value="<?php echo $data['nim']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?php echo $data['nama']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="<?php echo $data['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="number" class="form-control" id="no_hp" name="no_hp"
                                value="<?php echo $data['no_hp']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" id="semester" name="semester" required>
                                <?php for($i=1;$i < 9; $i++): ?>
                                <option value="<?php echo $data['semester']; ?>"
                                    <?php if ($i == $data['semester']) echo 'selected'; ?>>
                                    <?php echo $i; ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ipk">IPK</label>
                            <input type="number" class="form-control" id="ipk" name="ipk"
                                value="<?php echo $data['ipk']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pilihan_beasiswa">Pilihan Beasiswa</label>
                            <select class="form-control" id="pilihan_beasiswa" name="pilihan_beasiswa" required>
                                <option value="akademik"
                                    <?php echo $data['pilihan_beasiswa'] === 'akademik' ? 'selected' : ''; ?>>
                                    Akademik</option>
                                <option value="non_akademik"
                                    <?php echo $data['pilihan_beasiswa'] === 'non_akademik' ? 'selected' : ''; ?>>
                                    Non Akademik</option>
                                <option value="prestasi"
                                    <?php echo $data['pilihan_beasiswa'] === 'prestasi' ? 'selected' : ''; ?>>
                                    Prestasi</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="berkas_syarat">Berkas Syarat</label>
                            <input type="text" class="form-control" id="berkas_syarat" name="berkas_syarat"
                                value="<?php echo $data['berkas_syarat']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="status_ajuan">Status Ajuan</label>
                            <select class="form-control" id="status_ajuan" name="status_ajuan" required>
                                <option value="Belum diverifikasi"
                                    <?php echo $data['status_ajuan'] === 'Belum diverifikasi' ? 'selected' : ''; ?>>
                                    Belum
                                    diverifikasi</option>
                                <option value="Sudah diverifikasi"
                                    <?php echo $data['status_ajuan'] === 'Sudah diverifikasi' ? 'selected' : ''; ?>>
                                    Sudah
                                    diverifikasi</option>
                            </select>

                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="hasil_beasiswa.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <?php include 'func/endtime.php'; ?>
        </div>
    </div>

    <?php include 'layout/script.php'; ?>
</body>

</html>

<?php

if ($result->num_rows == 0) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Data tidak ditemukan!"
        }).then(function() {
            window.location = "hasil_beasiswa.php";
        });
    </script>';
    exit();
}



// Tangani pembaruan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newNim = $_POST['nim'];
    $newNama = $_POST['nama'];
    $newEmail = $_POST['email'];
    $newNohp = $_POST['no_hp'];
    $newSemester = $_POST['semester'];
    $newIpk = $_POST['ipk'];
    $newBeasiswa = $_POST['pilihan_beasiswa'];
    $newStatus = $_POST['status_ajuan'];

    $query = "UPDATE beasiswa SET nim = '$newNim', nama = '$newNama', email = '$newEmail', no_hp = '$newNohp', semester = '$newSemester', ipk = '$newIpk', pilihan_beasiswa = '$newBeasiswa', status_ajuan = '$newStatus' WHERE id = '$editId'";
    if ($connection->query($query)) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Data Diperbarui",
                text: "Data berhasil diperbarui!"
            }).then(function() {
                window.location = "hasil_beasiswa.php";
            });
        </script>';
    }
}
?>