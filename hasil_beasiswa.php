<?php
include 'func/starttime.php'; 
include 'db/koneksi.php';

// Pagination settings
$recordsPerPage = 10; // Number of records to display per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $recordsPerPage; // Calculate offset

// Retrieve Data with Pagination
$query = "SELECT * FROM beasiswa LIMIT $recordsPerPage OFFSET $offset";
$result = $connection->query($query);
$beasiswaData = $result->fetch_all(MYSQLI_ASSOC);

// Get total records for pagination calculation
$totalQuery = "SELECT COUNT(*) AS total FROM beasiswa";
$totalResult = $connection->query($totalQuery);
$totalRecords = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $recordsPerPage);


// Retrieve Data
$query = "SELECT * FROM beasiswa";
$result = $connection->query($query);
$anggotaData = $result->fetch_all(MYSQLI_ASSOC);

$no = $offset + 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Beasiswa - Pilihan Beasiswa</title>
    <?php include 'layout/head.php'; ?>
</head>

<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="container mt-5">
        <h2>Data Hasil Beasiswa</h2>
        <a href="daftar_beasiswa.php" class="btn btn-primary mb-3">Daftar Beasiswa</a>
        <table class="table table-striped table-responsive table-hover  table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Semester</th>
                    <th>IPK</th>
                    <th>Pilihan Beasiswa</th>
                    <th>Berkas Syarat</th>
                    <th>Status Ajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($beasiswaData as $data): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['no_hp']; ?></td>
                    <td><?php echo $data['semester']; ?></td>
                    <td><?php echo $data['ipk']; ?></td>
                    <td><?php echo $data['pilihan_beasiswa']; ?></td>
                    <td><a href="<?php echo $data['berkas_syarat']; ?>" target="_blank">Download</a></td>
                    <td>
                        <?php
                            if ($data['status_ajuan'] === 'Belum diverifikasi') {
                                echo '<span class="badge badge-danger">' . $data['status_ajuan'] . '</span>';
                            } elseif ($data['status_ajuan'] === 'Sudah diverifikasi') {
                                echo '<span class="badge badge-success">' . $data['status_ajuan'] . '</span>';
                            } else {
                                echo '<span class="badge badge-secondary">' . $data['status_ajuan'] . '</span>';
                            }
                        ?>
                    </td>
                    <td>
                        <a href="edit_beasiswa.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                        <button class="btn btn-danger"
                            onclick="confirmDelete(<?php echo $data['id']; ?>)">Hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a>
                </li>
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?php if($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php include 'func/endtime.php'; ?>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement("form");
                    form.method = "POST";
                    form.action = "";

                    var hiddenField = document.createElement("input");
                    hiddenField.type = "hidden";
                    hiddenField.name = "delete_id";
                    hiddenField.value = id;

                    form.appendChild(hiddenField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

    <?php include 'layout/script.php'; ?>

</body>

</html>


<?php
// Handle Delete Request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $deleteId = $connection->real_escape_string($_POST['delete_id']);
    
    $query = "DELETE FROM beasiswa WHERE id = '$deleteId'";
    if ($connection->query($query)) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Data Terhapus",
                text: "Data berhasil dihapus!"
            }).then(function() {
                window.location = "hasil_beasiswa.php";
            });
        </script>';
    }
}

?>