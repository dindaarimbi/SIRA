<!DOCTYPE html>
<html lang="id">
<?php
$kriteria = $kriteria ?? [];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kriteria Akreditasi - SIREPO TIF</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('style_kriterialist.css') ?>">
</head>
<body>

<div class="page-header">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <span class="brand-title">SIREPO TIF</span>
            <span class="text-muted small ms-2">Universitas Malikussaleh</span>
        </div>
    </div>
</div>

<div class="hero-dashboard-section mb-5">
    <div class="container">
        <h2 class="fw-bold m-0">KRITERIA AKREDITASI</h2>
        <p class="m-0 text-white-50 small mt-2">Selamat datang di instrumen akreditasi Teknik Informatika. Silakan pilih kriteria untuk mengelola data atau meninjau capaian.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <?php foreach($kriteria as $k): ?>
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card kriteria-card p-4">
                
                <div class="d-flex align-items-start gap-3 mb-4">
                    <span class="kriteria-code-badge">
                        <?= $k['kode_kriteria']; ?>
                    </span>
                    <h5 class="kriteria-title m-0 mt-1">
                        <?= $k['nama_kriteria']; ?>
                    </h5>
                </div>

                <div class="btn-action-panel">
    <?php if (session()->get('role') === 'admin') : ?>
        <a href="<?= base_url('forminput/' . $k['id_kriteria']); ?>" class="btn-menu btn-menu-input">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            Kelola Data
        </a>
    <?php endif; ?>
    
    <a href="<?= base_url('hasil/' . $k['id_kriteria']); ?>" class="btn-menu btn-menu-report">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Lihat Capaian
    </a>
</div>

            </div>
        </div>
        <?php endforeach; ?>
    </div> 
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>