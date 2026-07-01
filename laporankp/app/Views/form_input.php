<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penilaian Kriteria - SIRA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">

    <script>
        function toggleUpload(id) {
            let box = document.getElementById("upload_" + id);
            let radio = document.querySelector('input[name="status['+id+']"]:checked');

            if (radio && radio.value === "tersedia") {
                box.style.display = "block";
            } else {
                box.style.display = "none";
            }
        }
    </script>
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
    <div class="container" style="max-width: 800px;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold m-0">Form Penilaian Kriteria</h3>
                <p class="m-0 text-white-50 small mt-1">Silakan lakukan pengecekan kriteria dan unggah bukti pendukung.</p>
            </div>
            <a href="<?= base_url('kriteria') ?>" class="btn btn-back d-flex align-items-center gap-2">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="container" style="max-width: 800px;">

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4" role="alert" style="background-color: #D1E7DD; color: #0F5132; border-radius: 12px;">
            <svg class="bi flex-shrink-0 me-2" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <div class="small fw-medium">
                <?= session()->getFlashdata('success'); ?>
            </div>
        </div>
    <?php endif; ?>

    <form action="/forminput/simpan" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id_kriteria" value="<?= $id_kriteria ?>">

        <?php foreach($indikator as $i): ?>

        <div class="card custom-card mb-4">
            <div class="card-body p-4">

                <div class="d-flex align-items-start gap-3 mb-4">
                    <span class="indikator-badge">
                        <?= $i['kode_indikator']; ?>
                    </span>
                    <h5 class="indikator-title m-0 mt-1">
                        <?= $i['nama_indikator']; ?>
                    </h5>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary small text-uppercase tracking-wider">Status Dokumen</label>
                    <div class="status-container d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input"
                                    type="radio"
                                    id="status_ada_<?= $i['id_indikator']; ?>"
                                    name="status[<?= $i['id_indikator']; ?>]"
                                    value="tersedia"
                                    onclick="toggleUpload(<?= $i['id_indikator']; ?>); hitungNilai(<?= $i['id_indikator']; ?>)"
                                    <?= (!empty($i['penilaian']) && ($i['penilaian']['nilai'] == 4 || $i['penilaian']['nilai'] == 1)) ? 'checked' : '' ?>>
                            <label class="form-check-label fw-medium" style="cursor:pointer;" for="status_ada_<?= $i['id_indikator']; ?>">Tersedia</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input"
                                    type="radio"
                                    id="status_tidak_<?= $i['id_indikator']; ?>"
                                    name="status[<?= $i['id_indikator']; ?>]"
                                    value="tidak"
                                    onclick="toggleUpload(<?= $i['id_indikator']; ?>); hitungNilai(<?= $i['id_indikator']; ?>)"
                                    <?= (isset($i['penilaian']['nilai']) && $i['penilaian']['nilai'] == 0) ? 'checked' : '' ?>>
                            <label class="form-check-label fw-medium" style="cursor:pointer;" for="status_tidak_<?= $i['id_indikator']; ?>">Tidak Tersedia</label>
                        </div>
                    </div>
                </div>

                <div id="upload_<?= $i['id_indikator']; ?>" style="display:none;" class="mb-4">
                    <label class="form-label fw-bold text-secondary small text-uppercase tracking-wider">Upload Bukti Fisik</label>
                    
                    <?php if(!empty($i['penilaian']['file_bukti'])): ?>
                        <div class="mb-2 text-success small d-flex align-items-center gap-1">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
                            File tersimpan: <span class="fw-bold"><?= $i['penilaian']['file_bukti']; ?></span>
                        </div>
                    <?php endif; ?>

                    <input type="file"
                            id="file_<?= $i['id_indikator']; ?>"
                            name="file_bukti[<?= $i['id_indikator']; ?>]"
                            class="form-control"
                            onchange="hitungNilai(<?= $i['id_indikator']; ?>)">
                    <div class="form-text text-muted small">Ekstensi file diizinkan: PDF / JPG / PNG (Maks. 2MB).</div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary small text-uppercase tracking-wider">Catatan Tambahan</label>
                    <textarea name="catatan[<?= $i['id_indikator']; ?>]"
                            class="form-control"
                              placeholder="Tulis alasan atau catatan pelengkap indikator disini..."
                              rows="2"><?= $i['penilaian']['catatan'] ?? '' ?></textarea>
                </div>

                <div>
                    <label class="form-label fw-bold text-secondary small text-uppercase m-0">
                        Nilai Indikator
                    </label>
                    <div id="nilai_<?= $i['id_indikator']; ?>" class="nilai-preview" style="font-size: 24px; font-weight: 700; margin-top: 5px;">
                        -
                    </div>
                </div>

            </div>
        </div>

        <?php endforeach; ?>

        <div class="mt-4 mb-5">
            <button type="submit" class="btn btn-submit w-100 shadow d-flex align-items-center justify-content-center gap-2" style="background-color: #16a34a; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                SIMPAN DAN UPDATE PENILAIAN
            </button>
        </div>

    </form>
</div>

<script>
function hitungNilai(id, nilaiDb = null, fileDbExits = false) {
    let radio = document.querySelector('input[name="status['+id+']"]:checked');
    let fileInput = document.getElementById('file_' + id);
    let box = document.getElementById('nilai_' + id);

    let nilai = '-';
    let warna = '#64748B'; 

    if (radio) {
        if (radio.value === 'tidak') {
            // REVISI: Tidak tersedia = 0
            nilai = '0';
            warna = '#EF4444'; // Merah
        } else {
            // Jika radio bernilai 'tersedia'
            let adaFileBaru = fileInput && fileInput.files.length > 0;
            
            if (adaFileBaru || fileDbExits) {
                // REVISI: Tersedia & Ada berkas = 4
                nilai = '4';
                warna = '#16A34A'; // Hijau
            } else {
                // REVISI: Tersedia & Berkas kosong = 1
                nilai = '1';
                warna = '#0EA5E9'; // Biru
            }
        }
    }

    if (box) {
        box.innerHTML = nilai;
        box.style.color = warna;
    }
}

// Jalankan kalkulasi awal otomatis saat halaman dibuka
document.addEventListener("DOMContentLoaded", function () {
    <?php foreach($indikator as $i): ?>
        // Jalankan efek buka/tutup container upload bukti fisik
        toggleUpload(<?= $i['id_indikator']; ?>);
        
        // Cek apakah data file sudah pernah tersimpan di database untuk indikator ini
        let fileDbExits_<?= $i['id_indikator']; ?> = <?= (!empty($i['penilaian']['file_bukti'])) ? 'true' : 'false'; ?>;
        
        // Panggil kalkulasi
        hitungNilai(<?= $i['id_indikator']; ?>, null, fileDbExits_<?= $i['id_indikator']; ?>);
    <?php endforeach; ?>
});
</script>

</body>
</html>