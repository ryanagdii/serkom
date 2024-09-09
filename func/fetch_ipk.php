<?php
if (isset($_POST['nim']) && isset($_POST['semester'])) {
    $nim = $_POST['nim'];
    $semester = $_POST['semester'];

    include '../db/koneksi.php';

    // Mengambil data ipk berdasarkan nim dan semester
    $query = "SELECT ipk FROM mahasiswa WHERE nim = ? AND semester = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("si", $nim, $semester);
    $stmt->execute();
    $stmt->bind_result($ipk);
    $stmt->fetch();
    
    // Jika data ditemukan maka tampilkan ipk jika tidak akan menampilkan '-'
    if ($ipk) {
        echo $ipk;
    } else {
        echo '-';
    }

    $stmt->close();
    $connection->close();
}
?>
