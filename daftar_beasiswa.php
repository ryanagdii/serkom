<?php
include 'func/starttime.php'; 
include 'db/koneksi.php';

$query = "SELECT * FROM mahasiswa";
$result = $connection->query($query);
$mahasiswaData = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Beasiswa - Pilihan Beasiswa</title>
    <?php include 'layout/head.php'; ?>
</head>

<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="container mt-3">
        <div class="text-center">
            <h2>Daftar Beasiswa</h2>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-header">
                    Registrasi Beasiswa
                </div>
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <table class="table table-borderless">
                            <tr>
                                <td><label for="nim">NIM</label></td>
                                <td>
                                    <input type="number" class="form-control" id="daftarnim" name="daftarnim" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="nama">Nama</label></td>
                                <td>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="no_hp">No HP</label></td>
                                <td>
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="semester">Semester saat ini</label></td>
                                <td>
                                    <select class="form-control" id="daftarsemester" name="daftarsemester" required
                                        onchange="fetchIPK()">
                                        <option value="" selected disabled>Pilih Semester</option>
                                        <?php for($i=1;$i < 9; $i++): ?>
                                        <option value="<?php echo $i ?>">
                                            <?php echo $i ?>
                                        </option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="ipk">IPK terakhir</label></td>
                                <td>
                                    <input type="hidden" id="daftaripk" name="daftaripk">
                                    <input type="text" class="form-control" id="ipk_display" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="pilihan_beasiswa">Pilihan Beasiswa</label></td>
                                <td>
                                    <select class="form-control" id="pilihan_beasiswa" name="pilihan_beasiswa" required>
                                        <option selected disabled>Pilih Beasiswa</option>
                                        <option value="akademik">Akademik</option>
                                        <option value="non_akademik">Non Akademik</option>
                                        <option value="prestasi">Prestasi</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="upload_file">Upload Berkas Syarat</label></td>
                                <td>
                                    <input type="file" class="form-control" id="berkas_syarat" name="berkas_syarat"
                                        accept=".pdf">
                                </td>
                            </tr>
                        </table>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary" id="submit_button">Daftar</button>
                            <a href="." class="btn btn-danger">Batal</a>
                        </div>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['daftarnim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $semester = $_POST['daftarsemester'];
    $pilihan_beasiswa = $_POST['pilihan_beasiswa'];
    $ipk = $_POST['daftaripk']; // IPK diambil dari form hidden

    // File upload handling
    $upload_dir = 'uploads/';
    $file_name = basename($_FILES['berkas_syarat']['name']);
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_file_name = rand(1, 999999) . '_' . pathinfo($file_name, PATHINFO_FILENAME) . '.' . $file_ext;
    $upload_file = $upload_dir . $new_file_name;
    $upload_success = move_uploaded_file($_FILES['berkas_syarat']['tmp_name'], $upload_file);

    if (!$upload_success) {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "File Upload gagal",
                text: "Terjadi kesalahan saat upload file!"
            });
        </script>';
        exit;
    }

    // Prepare SQL query
    $query = "INSERT INTO beasiswa (nim, nama, email, no_hp, semester, ipk, pilihan_beasiswa, berkas_syarat, status_ajuan) 
          VALUES ('$nim', '$nama', '$email', '$no_hp', '$semester', '$ipk', '$pilihan_beasiswa', '$upload_file', 'Belum diverifikasi')";

    if ($connection->query($query)) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Daftar Beasiswa Berhasil",
                text: "Pendaftaran beasiswa berhasil!"
            }).then(function() {
                window.location = "hasil_beasiswa.php";
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Daftar Beasiswa Gagal",
                text: "Terjadi kesalahan saat pendaftaran beasiswa!"
            });
        </script>';
    }
}

?>