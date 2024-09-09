<?php include 'func/starttime.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php include 'layout/head.php'; ?>
</head>

<body>
    <?php include 'layout/navbar.php'; ?>
    <div class="container mt-5">
        <h3>Selamat datang di Halaman Pilihan Beasiswa!</h3>
        <div class="card-deck mt-5">
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header bg-info text-light">Beasiswa Akademik</div>
                <div class="card-body">
                    <h5 class="card-title">Pendaftaran Beasiswa Akademik</h5>
                    <p class="card-text">Kamu bisa mendaftar untuk mendapatkan beasiswa akademik dengan minimal IPK 3.0
                    </p>
                </div>
                <div class="card-footer">
                    <a href="daftar_beasiswa.php"><small class="badge badge-pill badge-info">Daftar Sekarang</small></a>
                </div>
            </div>
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header bg-info text-light">Beasiswa Non Akademik</div>
                <div class="card-body">
                    <h5 class="card-title">Pendaftaran Beasiswa Non Akademik</h5>
                    <p class="card-text">Kamu bisa mendaftar untuk mendapatkan beasiswa non akademik dengan minimal IPK
                        3.0</p>
                </div>
                <div class="card-footer">
                    <a href="daftar_beasiswa.php"><small class="badge badge-pill badge-info">Daftar Sekarang</small></a>
                </div>
            </div>
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header bg-info text-light">Beasiswa Prestasi</div>
                <div class="card-body">
                    <h5 class="card-title">Pendaftaran Beasiswa Prestasi</h5>
                    <p class="card-text">Kamu bisa mendaftar untuk mendapatkan beasiswa prestasi dengan minimal IPK 3.0
                    </p>
                </div>
                <div class="card-footer">
                    <a href="daftar_beasiswa.php"><small class="badge badge-pill badge-info">Daftar Sekarang</small></a>
                </div>
            </div>
        </div>
        <?php include 'func/endtime.php'; ?>
    </div>
</body>

</html>