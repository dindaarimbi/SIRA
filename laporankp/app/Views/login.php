<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIRA</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?= base_url('style_login.css') ?>">
</head>
<body>
    
<div id="splash-screen">
    <div class="splash-content">
        <img src="<?= base_url('images/logo-kriterra-besar.png') ?>" alt="Logo Kriterra" class="splash-logo">
        
        <div class="splash-loader">
            <div class="loader-progress"></div>
        </div>
    </div>
</div>

<div class="login-card">
    <img src="<?= base_url('images/logo-unimal.png') ?>" alt="Logo Unimal" class="brand-logo">
    
    <h4 class="text-center fw-bold m-0" style="color: #276547;">SIRA</h4>
    <p class="text-center text-muted small mt-1 mb-4">Sistem Informasi Reakreditasi<br>-Teknik Informatika-</p>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger border-0 small py-2 mb-3" role="alert">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('login/action') ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autocomplete="off">
        </div>
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk</button>
    </form>
    
    <p class="text-center text-muted mt-4 mb-0" style="font-size: 11px;">Hubungi admin jurusan jika mengalami kendala akses.</p>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Menunggu selama 2.5 detik agar user bisa menikmati animasi masuknya
    setTimeout(function() {
        const splash = document.getElementById('splash-screen');
        if (splash) {
            splash.classList.add('fade-out');
        }
    }, 2500); 
});
</script>
</body>
</html>