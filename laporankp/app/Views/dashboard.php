<?php
$kriteria = $kriteria ?? [];
$nama = $nama ?? 'Pengguna';
$role = $role ?? '';
$total_kriteria = $total_kriteria ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard SIRA</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet"
href="<?= base_url('dashboard.css') ?>">

</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar hide-sidebar">

            <div class="sidebar-logo">

                <div class="logo-unimal">

                <img
                src="<?= base_url('images/logo-unimal.png') ?>"
                alt="Logo Unimal">

            </div>

            <div>
                <div class="logo-text">
                    SIRA
                </div>

                <div class="logo-text-1">
                    TEKNIK INFORMATIKA
                </div>
            </div>

        </div>

        <div class="menu-title mt-4">
                DAFTAR KRITERIA
            </div>

            <?php $no=1; ?>

            <?php foreach($kriteria as $k): ?>

            <a href="<?= base_url('hasil/'.$k->id_kriteria) ?>" class="menu-item">
                <?= $no++ ?>.
                <?= $k->nama_kriteria ?>
            </a>

            <?php endforeach; ?>

        <div class="logout-box">

            <a href="<?= base_url('logout') ?>"
            class="menu-item logout-btn">

                <i class="fa-solid fa-right-from-bracket"></i>
                Keluar

            </a>

        </div>

    </aside>

    <!-- CONTENT -->
    <main class="main-content full-content">

        <!-- TOPBAR -->
        <div class="topbar">

            <div class="d-flex align-items-center">

                <button id="toggleSidebar" class="toggle-btn me-3">
                    <i class="fas fa-bars"></i>
                </button>

                <strong id="headerTitle">
                    SIRA
                </strong>

            </div>

            <div class="user-box">

                <i class="fa-solid fa-user-circle"></i>

                Halo,
                <strong><?= esc($nama) ?></strong>

            </div>

        </div>

        <div class="container-fluid p-4">

            <h2 class="fw-bold">
                SELAMAT DATANG DI WEBSITE SIRA
            </h2>

            <p class="text-muted">
                Kelola dan pantau proses akreditasi program studi dengan mudah dan terstruktur.
            </p>

            <!-- CARD -->
            <div class="row mt-4">

                <div class="col-md-4 mb-3">

                    <div class="stat-card">

                        <div class="icon purple">
                            <i class="fa-solid fa-ranking-star"></i>
                        </div>

                        <div>

                            <h3><?= $total_kriteria ?></h3>

                            <p>Nilai Akhir</p>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="stat-card">

                        <div class="icon green">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>

                        <div>

                            <h3><?= $sudah_diisi ?? 0 ?></h3>
                            <p>Indikator Sudah Diisi</p>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="stat-card">

                        <div class="icon red">
                        <i class="fa-solid fa-file-circle-xmark"></i>
                    </div>

                    <div>

                        <h3><?= $belum_upload ?? 0 ?></h3>
                        <p>Indikator Belum Diisi</p>

                    </div>

                    </div>

                </div>

            </div>

            <!-- DAFTAR KRITERIA -->
             <div class="hero-dashboard-section">
    <div class="container">
        <h2 class="fw-bold m-0">KRITERIA AKREDITASI</h2>
    </div>
</div>
            <div class="container mb-5">
    <div class="row">
        <?php foreach($kriteria as $k): ?>
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card kriteria-card p-4">
                
                <div class="d-flex align-items-start gap-3 mb-4">
                    <span class="kriteria-code-badge">
                        <?= $k->kode_kriteria; ?>
                    </span>
                    <h5 class="kriteria-title m-0 mt-1">
                        <?= $k->nama_kriteria; ?>
                    </h5>
                </div>

                    <div class="btn-action-panel <?= session()->get('role') != 'admin' ? 'single' : '' ?>">
                        <?php if(session()->get('role') == 'admin'): ?>
                            <a href="<?= base_url('forminput/' . $k->id_kriteria); ?>" class="btn-menu btn-menu-input">
                                Kelola Data
                            </a>

                            <a href="<?= base_url('hasil/' . $k->id_kriteria); ?>" class="btn-menu btn-menu-report">
                                Lihat Capaian
                            </a>
                        <?php else: ?>
                            <a href="<?= base_url('hasil/' . $k->id_kriteria); ?>" class="btn-menu btn-menu-input">
                                Lihat Capaian
                            </a>
                        <?php endif; ?>

                    </div>

            </div>
        </div>
        <?php endforeach; ?>
    </div> 
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

const btn =
document.getElementById('toggleSidebar');

const sidebar =
document.querySelector('.sidebar');

const content =
document.querySelector('.main-content');

const headerTitle =
document.getElementById('headerTitle');

btn.addEventListener('click',()=>{

    sidebar.classList.toggle('hide-sidebar');

    content.classList.toggle('full-content');

    if(sidebar.classList.contains('hide-sidebar'))
    {
        headerTitle.style.display='block';
    }
    else
    {
        headerTitle.style.display='none';
    }

});

</script>
</body>
</html>