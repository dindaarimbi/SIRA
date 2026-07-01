<!DOCTYPE html>
<html lang="id">
<?php
$kriteria = $kriteria ?? [];
$hasil = $hasil ?? [];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penilaian <?= $kriteria['kode_kriteria']; ?> - SIREPO TIF</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('style_hasilpenilaian.css') ?>">
</head>
<body>

<div class="page-header">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <span class="brand-title">SIRA</span>
            <span class="text-muted small ms-2">Sistem Informasi Reakreditasi -Teknik Informatika-</span>
        </div>
    </div>
</div>

<div class="hero-form-section mb-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span class="badge bg-warning text-dark mb-2 fw-bold" style="background-color: var(--accent-gold) !important; color: #fff !important;">
                    <?= $kriteria['kode_kriteria']; ?>
                </span>
                <h3 class="fw-bold m-0"><?= $kriteria['nama_kriteria']; ?></h3>
                <p class="m-0 text-white-50 small mt-1">Daftar capaian nilai indikator akreditasi berdasarkan rekaman database.</p>
            </div>
            <a href="<?= base_url('kriteria') ?>" class="btn btn-back d-flex align-items-center gap-2">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="container mb-5">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center gap-2" role="alert" style="background-color: #D1E7DD; color: #0F5132; border-radius: 12px; padding: 16px;">
            <svg width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <div>
                <?= session()->getFlashdata('success'); ?>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center mb-4">

    <div class="col-lg-3 col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <small class="text-muted">Total Nilai</small>
                <h3><?= $totalNilai ?></h3>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <small class="text-muted">Bobot</small>
                <h3><?= $kriteria['bobot'] ?>%</h3>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-4">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body text-center">
                <small>Nilai Akhir</small>
                <h3><?= number_format($nilaiAkhir, 2) ?></h3>
            </div>
        </div>
    </div>

</div>

    <div class="table-container">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
            <h5 class="fw-bold m-0" style="color: var(--text-dark);">Tabel Ringkasan Penilaian</h5>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover m-0">
                <thead>
                    <tr>
                        <th width="80">Kode</th>
                        <th width="120">Kategori</th>
                        <th>Nama Indikator</th>
                        <th width="140" class="text-center">Status</th>
                        <th width="80" class="text-center">Nilai</th>
                        <th width="150">Bukti Fisik</th>
                        <th>Catatan</th>
                        <th width="80" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($hasil)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">Belum ada data indikator pada kriteria ini.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($hasil as $h): ?>
                            <tr>
                                <td><span class="fw-bold text-dark"><?= $h['kode_indikator']; ?></span></td>
                                <td><span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 11px;"><?= $h['kategori']; ?></span></td>
                                <td class="fw-medium text-secondary" style="max-width: 300px; line-height: 1.5;"><?= $h['nama_indikator']; ?></td>
                                <td class="text-center">
                                    <?php 
                                        $class_status = 'status-belum'; $text_status = 'Belum Diisi';
                                        if($h['status'] == 'Sangat Baik') { $class_status = 'status-sangat-baik'; $text_status = 'Sangat Baik'; }
                                        elseif($h['status'] == 'Baik') { $class_status = 'status-baik'; $text_status = 'Baik'; }
                                        elseif($h['status'] == 'Cukup') { $class_status = 'status-cukup'; $text_status = 'Cukup'; }
                                        elseif($h['status'] == 'Kurang') { $class_status = 'status-kurang'; $text_status = 'Kurang'; }
                                    ?>
                                    <span class="badge-status <?= $class_status; ?>"><?= $text_status; ?></span>
                                </td>
                                <td class="text-center fw-bold fs-5 <?= $h['nilai'] >= 3 ? 'text-success' : ($h['nilai'] == 2 ? 'text-warning' : 'text-danger'); ?>">
                                    <?= $h['nilai'] ?? '-'; ?>
                                </td>
                                <td>
                                    <?php if(!empty($h['file_bukti'])): ?>
                                        <a href="<?= base_url('writable/uploads/' . $h['file_bukti']) ?>" target="_blank" class="btn-download btn-download-active">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat File
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small-text text-italic opacity-50">Tidak ada file</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted small" style="max-width: 200px;">
                                    <?= !empty($h['catatan']) ? esc($h['catatan']) : '<span class="opacity-25">-</span>'; ?>
                                </td>
                                
                                <td class="text-center">
                                    <?php if(session()->get('role') == 'admin'): ?>

                                        <?php if(!empty($h['id_penilaian'])): ?>

                                            <a href="<?= base_url('hasil/hapus/' . $h['id_penilaian']) ?>"
                                            class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
                                            style="border-radius: 8px; padding: 6px 10px;"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data penilaian dan file bukti ini secara permanen?')">

                                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>

                                            </a>

                                        <?php else: ?>

                                            <span class="text-muted opacity-25">-</span>

                                        <?php endif; ?>

                                    <?php else: ?>

                                        <span class="text-muted opacity-25">-</span>

                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>