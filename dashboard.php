<?php
session_start(); // Memulai session

// Jika user belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - My Parkuy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
              <img src="assets/img/logo.png" alt="Logo My Parkuy" width="26" class="rounded" />
              <span class="fw-semibold">My Parkuy Dashboard</span>
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container py-5">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                <p class="col-md-8 fs-4">Ini adalah halaman dashboard Anda. Dari sini Anda bisa mengelola riwayat pemesanan dan pengaturan akun.</p>
                <button class="btn btn-primary btn-lg" type="button">Lihat Riwayat</button>
            </div>
        </div>
    </main>

</body>
</html>