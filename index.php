<?php
// Cek apakah ada data yang dikirim melalui metode GET dari form pencarian
$search_location = isset($_GET['location']) ? htmlspecialchars($_GET['location']) : '';
$search_datetime = isset($_GET['datetime']) ? htmlspecialchars($_GET['datetime']) : '';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Zeydan Fazle Mawla" />
    <title>My Parkuy - Solusi Mudah Parkir</title>
    <meta name="description"
        content="My Parkuy: solusi parkir online untuk menemukan, memesan, dan membayar tempat parkir dengan mudah." />
    <!-- icon -->
    <link rel="icon" href="assets/img/logo.png" type="image/png" sizes="32x32" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Custom Styles -->
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="assets/img/logo.png" alt="Logo My Parkuy" width="26" class="rounded" />
                <span class="fw-semibold">My Parkuy</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Harga</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    <li class="nav-item" id="magic-line"></li>
                </ul>

                <div class="ms-lg-3 mt-2 mt-lg-0 d-grid d-lg-flex gap-2">
                    <button id="theme-toggle"
                        class="btn btn-outline-primary d-flex justify-content-center align-items-center gap-2"
                        type="button" aria-label="Toggle dark mode">
                        <i class="bi bi-moon-stars" aria-hidden="true"></i>
                        <span>Theme</span>
                    </button>
                    <a href="login.php" class="btn btn-primary d-flex justify-content-center align-items-center gap-2">
                        <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                        <span>Login</span>
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <!-- Header / Hero -->
    <header class="hero py-5 py-lg-6 section-diagonal-bottom">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <h1 class="display-5 fw-bold mb-3">My Parkuy</h1>
                    <p class="lead text-secondary mb-4">
                        Temukan, pesan, dan bayar tempat parkir terdekat dalam hitungan
                        menit.
                    </p>
                    <form action="#booking" method="get" aria-label="Form pencarian parkir"
                        class="card shadow-sm border-0 glass">
                        <fieldset class="card-body">
                            <legend class="visually-hidden">Cari tempat parkir</legend>
                            <div class="row g-3 align-items-end">
                                <div class="col-12 col-md-6">
                                    <label for="location" class="form-label">Lokasi (kota atau alamat)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="search" id="location" name="location" class="form-control"
                                            placeholder="Contoh: Jalan Suryanata" required />
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="datetime" class="form-label">Tanggal & waktu</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                        <input type="datetime-local" id="datetime" name="datetime"
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search me-2"></i>Cari
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-lg-5 text-center text-lg-end">
                    <img src="assets/img/ilustration.png" alt="Ilustrasi aplikasi parkir online" class="img-fluid"
                        width="400px" />
                </div>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main>
        <!-- Features -->
        <section id="features" aria-labelledby="features-heading"
            class="section-padding bg-surface section-diagonal-top section-diagonal-bottom aos">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between mb-3 mb-md-4">
                    <h2 id="features-heading" class="section-title mb-0">
                        Fitur Unggulan
                    </h2>
                </div>
                <ul class="features-grid list-unstyled">
                    <li>
                        <article class="feature-card card h-100 aos">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <h3 class="h6 feature-title">
                                    Temukan Tempat Parkir Terdekat
                                </h3>
                                <p class="text-secondary mb-0">
                                    Daftar lokasi parkir dari berbagai mitra publik dan privat
                                    dengan real-time availability.
                                </p>
                            </div>
                        </article>
                    </li>
                    <li>
                        <article class="feature-card card h-100 aos">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </div>
                                <h3 class="h6 feature-title">Pesan & Bayar Online</h3>
                                <p class="text-secondary mb-0">
                                    Pesan slot terlebih dahulu dan bayar melalui metode yang
                                    dipilih: dompet digital, kartu, atau transfer.
                                </p>
                            </div>
                        </article>
                    </li>
                    <li>
                        <article class="feature-card card h-100 aos">
                            <div class="card-body text-center">
                                <div class="feature-icon">
                                    <i class="bi bi-sign-turn-right-fill"></i>
                                </div>
                                <h3 class="h6 feature-title">Rute dan Navigasi</h3>
                                <p class="text-secondary mb-0">
                                    Dapatkan petunjuk arah ke slot parkir yang dipesan langsung
                                    dari aplikasi peta yang Anda gunakan.
                                </p>
                            </div>
                        </article>
                    </li>
                    <li>
                        <article class="feature-card card h-100 aos">
                            <div class="card-body text-center">
                                <div class="feature-icon"><i class="bi bi-receipt"></i></div>
                                <h3 class="h6 feature-title">Riwayat & Struk Digital</h3>
                                <p class="text-secondary mb-0">
                                    Riwayat transaksi, struk digital, dan pengingat masa berlaku
                                    parkir.
                                </p>
                            </div>
                        </article>
                    </li>
                </ul>
            </div>
        </section>

        <!-- How it works -->
        <section id="how" aria-labelledby="how-heading" class="section-padding aos">
            <div class="container">
                <h2 id="how-heading" class="section-title">Cara Kerja</h2>
                <div class="steps-grid" role="list">
                    <article class="step-card aos" role="listitem">
                        <div class="step-head">
                            <span class="step-num">1</span>
                        </div>
                        <h3 class="h6 step-title">
                            <i class="bi bi-geo-alt-fill text-primary me-2"></i>Input Lokasi
                            & Waktu
                        </h3>
                        <p class="step-desc">
                            Masukkan lokasi dan waktu parkir yang diinginkan.
                        </p>
                    </article>
                    <article class="step-card aos" role="listitem">
                        <div class="step-head">
                            <span class="step-num">2</span>
                        </div>
                        <h3 class="h6 step-title">
                            <i class="bi bi-list-check text-primary me-2"></i>Pilih Slot
                            Tersedia
                        </h3>
                        <p class="step-desc">
                            Pilih slot parkir yang tersedia dan lihat detail seperti harga
                            serta jam operasi.
                        </p>
                    </article>
                    <article class="step-card aos" role="listitem">
                        <div class="step-head">
                            <span class="step-num">3</span>
                        </div>
                        <h3 class="h6 step-title">
                            <i class="bi bi-credit-card-2-front text-primary me-2"></i>Pesan
                            & Bayar
                        </h3>
                        <p class="step-desc">
                            Pesan dan lakukan pembayaran melalui metode yang tersedia.
                        </p>
                    </article>
                    <article class="step-card aos" role="listitem">
                        <div class="step-head">
                            <span class="step-num">4</span>
                        </div>
                        <h3 class="h6 step-title">
                            <i class="bi bi-qr-code text-primary me-2"></i>Dapatkan Bukti
                        </h3>
                        <p class="step-desc">
                            Terima bukti transaksi berupa kode dan QR untuk validasi.
                        </p>
                    </article>
                    <article class="step-card aos" role="listitem">
                        <div class="step-head">
                            <span class="step-num">5</span>
                        </div>
                        <h3 class="h6 step-title">
                            <i class="bi bi-sign-turn-right-fill text-primary me-2"></i>Navigasi ke Lokasi
                        </h3>
                        <p class="step-desc">
                            Terima konfirmasi dan navigasi ke lokasi parkir.
                        </p>
                    </article>
                    <article class="step-card aos" role="listitem">
                        <div class="step-head">
                            <span class="step-num">6</span>
                        </div>
                        <h3 class="h6 step-title">
                            <i class="bi bi-check2-circle text-primary me-2"></i>Selesai
                        </h3>
                        <p class="step-desc">Nikmati parkir tanpa repot.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- Booking example (placeholder list) -->
        <section id="booking" aria-labelledby="booking-heading" class="section-padding bg-surface section-diagonal-top">
            <div class="container">
                <h2 id="booking-heading" class="section-title">
                    Contoh Hasil Pencarian
                </h2>
                <ul class="row g-4 list-unstyled">
                    <li class="col-12 col-md-6">
                        <article class="card h-100">
                            <div class="card-body">
                                <h3 class="h5 mb-2">Mall Central Parking</h3>
                                <p class="text-secondary">
                                    Alamat: Jl. Contoh No.1 — Kapasitas tersisa: 12 slot —
                                    Harga: Rp 5.000/jam
                                </p>
                                <form action="#" method="post" aria-label="Pesan Mall Central Parking" class="row g-3">
                                    <input type="hidden" name="location_id" value="mall-central-1" />
                                    <div class="col-12 col-sm-8">
                                        <label for="vehicle-1" class="form-label">Nomor kendaraan</label>
                                        <input id="vehicle-1" name="plate" class="form-control"
                                            placeholder="KT 1234 XYZ" required />
                                    </div>
                                    <div class="col-12 col-sm-4 d-grid align-self-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-bag-check me-2"></i>Pesan Sekarang
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </article>
                    </li>
                    <li class="col-12 col-md-6">
                        <article class="card h-100">
                            <div class="card-body">
                                <h3 class="h5 mb-2">Gedung Office Park</h3>
                                <p class="text-secondary">
                                    Alamat: Jl. Contoh II — Kapasitas tersisa: 4 slot — Harga:
                                    Rp 8.000/jam
                                </p>
                                <form action="#" method="post" aria-label="Pesan Gedung Office Park" class="row g-3">
                                    <input type="hidden" name="location_id" value="office-park-2" />
                                    <div class="col-12 col-sm-8">
                                        <label for="vehicle-2" class="form-label">Nomor kendaraan</label>
                                        <input id="vehicle-2" name="plate" class="form-control"
                                            placeholder="KT 5678 ABC" required />
                                    </div>
                                    <div class="col-12 col-sm-4 d-grid align-self-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-bag-check me-2"></i>Pesan Sekarang
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </article>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Pricing -->
        <section id="pricing" aria-labelledby="pricing-heading" class="section-padding aos">
            <div class="container">
                <h2 id="pricing-heading" class="section-title">Pilihan Harga</h2>
                <p class="text-secondary">
                    Model harga fleksibel: per jam, per hari, atau langganan bulanan
                    untuk pengguna rutin.
                </p>

                <div class="pricing-grid">
                    <article class="pricing-card aos">
                        <header class="pricing-header">
                            <h3 class="h5 mb-1">Reguler</h3>
                            <p class="text-secondary small mb-0">Per jam</p>
                        </header>
                        <div class="pricing-body">
                            <p class="price mb-2">
                                Rp 5.000<span class="text-secondary">/jam</span>
                            </p>
                            <ul class="list-unstyled small mb-3">
                                <li>
                                    <i class="bi bi-check-circle text-primary me-1"></i> Tarif
                                    standar per jam
                                </li>
                                <li>
                                    <i class="bi bi-check-circle text-primary me-1"></i> Cocok
                                    untuk kunjungan singkat
                                </li>
                            </ul>
                            <button class="btn btn-outline-primary w-100">
                                Pilih Reguler
                            </button>
                        </div>
                    </article>

                    <article class="pricing-card is-featured aos">
                        <span class="badge badge-featured"><i class="bi bi-stars me-1"></i>Populer</span>
                        <header class="pricing-header">
                            <h3 class="h5 mb-1">Bulanan</h3>
                            <p class="text-secondary small mb-0">Langganan</p>
                        </header>
                        <div class="pricing-body">
                            <p class="price mb-2">
                                Rp 300.000<span class="text-secondary">/bulan</span>
                            </p>
                            <ul class="list-unstyled small mb-3">
                                <li>
                                    <i class="bi bi-check-circle text-primary me-1"></i> Slot
                                    tetap setiap hari
                                </li>
                                <li>
                                    <i class="bi bi-check-circle text-primary me-1"></i> Tanpa
                                    perlu pesan ulang
                                </li>
                                <li>
                                    <i class="bi bi-check-circle text-primary me-1"></i>
                                    Pengingat masa berlaku
                                </li>
                            </ul>
                            <button class="btn btn-primary w-100">Pilih Bulanan</button>
                        </div>
                    </article>

                    <article class="pricing-card aos">
                        <header class="pricing-header">
                            <h3 class="h5 mb-1">Harian</h3>
                            <p class="text-secondary small mb-0">Maks 24 jam</p>
                        </header>
                        <div class="pricing-body">
                            <p class="price mb-2">
                                Rp 30.000<span class="text-secondary">/hari</span>
                            </p>
                            <ul class="list-unstyled small mb-3">
                                <li>
                                    <i class="bi bi-check-circle text-primary me-1"></i> Tarif
                                    maksimal 24 jam
                                </li>
                                <li>
                                    <i class="bi bi-check-circle text-primary me-1"></i> Bebas
                                    keluar-masuk
                                </li>
                            </ul>
                            <button class="btn btn-outline-primary w-100">
                                Pilih Harian
                            </button>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Testimonials & Social proof -->
        <aside aria-labelledby="testimony-heading"
            class="section-padding testimonials-section bg-surface section-diagonal-top section-diagonal-bottom aos">
            <div class="container">
                <h2 id="testimony-heading" class="section-title">
                    Testimoni Pengguna
                </h2>
                <ul class="testimonials-grid list-unstyled">
                    <li>
                        <article class="testimonial-card aos">
                            <img class="avatar" src="assets/img/testimoni/testi-1.jpg" width="48" height="48"
                                alt="Foto pengguna" />
                            <div class="content">
                                <p class="mb-1">
                                    "Membantu banget, nggak perlu putar-putar cari parkir lagi!"
                                </p>
                                <span class="small text-secondary">King Dwiki</span>
                            </div>
                        </article>
                    </li>
                    <li>
                        <article class="testimonial-card aos">
                            <img class="avatar" src="assets/img/testimoni/testi-2.jpg" width="48" height="48"
                                alt="Foto pengguna" />
                            <div class="content">
                                <p class="mb-1">
                                    "Proses pemesanan cepat, pembayarannya juga aman."
                                </p>
                                <span class="small text-secondary">Timoti Jamal</span>
                            </div>
                        </article>
                    </li>
                    <li>
                        <article class="testimonial-card aos">
                            <img class="avatar" src="assets/img/testimoni/testi-3.jpg" width="48" height="48"
                                alt="Foto pengguna" />
                            <div class="content">
                                <p class="mb-1">
                                    "Rekomendasi parkirnya akurat, navigasinya juga pas."
                                </p>
                                <span class="small text-secondary">Lord Jordi</span>
                            </div>
                        </article>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- FAQ -->
        <section id="faq" aria-labelledby="faq-heading" class="section-padding">
            <div class="container">
                <h2 id="faq-heading" class="section-title">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <div class="faq-accordion" role="list">
                    <article class="faq-item" role="listitem">
                        <input class="faq-toggle" type="checkbox" id="faq1" />
                        <label class="faq-question" for="faq1">
                            Q: Bagaimana cara membatalkan pemesanan?
                            <i class="bi bi-chevron-down"></i>
                        </label>
                        <div class="faq-content">
                            <p>
                                A: Masuk ke riwayat pemesanan, pilih pemesanan yang ingin
                                dibatalkan, lalu tekan tombol batal. Ketentuan pembatalan
                                tergantung kebijakan lokasi.
                            </p>
                        </div>
                    </article>
                    <article class="faq-item" role="listitem">
                        <input class="faq-toggle" type="checkbox" id="faq2" />
                        <label class="faq-question" for="faq2">
                            Q: Apakah ada biaya layanan?
                            <i class="bi bi-chevron-down"></i>
                        </label>
                        <div class="faq-content">
                            <p>
                                A: Tergantung lokasi, beberapa mitra mengenakan biaya layanan
                                kecil per transaksi.
                            </p>
                        </div>
                    </article>
                    <article class="faq-item" role="listitem">
                        <input class="faq-toggle" type="checkbox" id="faq3" />
                        <label class="faq-question" for="faq3">
                            Q: Metode pembayaran apa yang diterima?
                            <i class="bi bi-chevron-down"></i>
                        </label>
                        <div class="faq-content">
                            <p>A: Dompet digital, kartu kredit/debit, dan transfer bank.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Contact -->
        <section id="contact" aria-labelledby="contact-heading"
            class="section-padding bg-surface section-diagonal-top contact-section aos">
            <div class="container">
                <h2 id="contact-heading" class="section-title">Hubungi Kami</h2>
                <div class="row g-4">
                    <div class="col-12 col-lg-5">
                        <address class="mb-0">
                            <ul class="contact-info-list list-unstyled">
                                <li>
                                    <div class="info-card">
                                        <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                                        <div>
                                            <div class="fw-semibold">Alamat kantor</div>
                                            <div>Jl. Anggur. 123, Samarinda</div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="info-card">
                                        <div class="info-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">E-mail</div>
                                            <div>
                                                <a href="mailto:admin@myparkuy.id">admin@myparkuy.id</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="info-card">
                                        <div class="info-icon">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold">Telepon</div>
                                            <div><a href="tel:+62211234567">(021) 123-4567</a></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </address>
                    </div>
                    <div class="col-12 col-lg-7">
                        <form action="#" method="post" aria-label="Form kontak" class="card shadow-sm border-0">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label for="name" class="form-label">Nama</label>
                                        <input id="name" name="name" class="form-control" required />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" name="email" type="email" class="form-control" required />
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">Pesan</label>
                                        <textarea id="message" name="message" rows="4" class="form-control"
                                            required></textarea>
                                    </div>
                                    <div class="col-12 d-grid d-sm-flex justify-content-sm-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-send me-2"></i>Kirim Pesan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-top py-4">
        <div class="container d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">
            <p class="mb-0 text-secondary">
                &copy; <time datetime="2025">2025</time> eparkir.id
            </p>
            <nav aria-label="Footer Navigation" class="d-flex align-items-center gap-3">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#privacy">Kebijakan Privasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#terms">Syarat & Ketentuan</a>
                    </li>
                </ul>
                <div class="socials d-flex align-items-center gap-2">
                    <a class="btn btn-icon" href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                    <a class="btn btn-icon" href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a class="btn btn-icon" href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a class="btn btn-icon" href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </nav>
        </div>
    </footer>

    <!-- Custom Scripts -->
    <script src="scripts.js"></script>
</body>

</html>