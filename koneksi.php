<?php
// koneksi.php
// Koneksi ke MySQL dan (opsional) auto-create database & tabel untuk demo

// Konfigurasi database
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'tempat_parkir'; // sesuai permintaan

// Koneksi ke server MySQL (tanpa memilih database dulu)
$conn = @new mysqli($DB_HOST, $DB_USER, $DB_PASS);
if ($conn->connect_error) {
    die('Koneksi ke MySQL gagal: ' . $conn->connect_error);
}

// Set charset
if (!$conn->set_charset('utf8mb4')) {
    // Abaikan kegagalan set charset, namun lanjutkan
}

// Buat database jika belum ada (untuk mempermudah setup)
$createDbSql = "CREATE DATABASE IF NOT EXISTS `{$DB_NAME}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
$conn->query($createDbSql);

// Pilih database
if (!$conn->select_db($DB_NAME)) {
    die('Gagal memilih database: ' . $conn->error);
}

// Buat tabel parkir jika belum ada
$createTableSql = <<<SQL
CREATE TABLE IF NOT EXISTS `parkir` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `noplat` VARCHAR(20) NOT NULL,
  `namapemilik` VARCHAR(100) NOT NULL,
  `jeniskendaraan` ENUM('Mobil','Motor','Lainnya') NOT NULL DEFAULT 'Mobil',
  `warnakendaraan` VARCHAR(50) NOT NULL,
  `keluar_masuk` ENUM('Masuk','Keluar') NOT NULL DEFAULT 'Masuk',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
    INDEX `idx_noplat` (`noplat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

$conn->query($createTableSql);

// Catatan: variabel $conn akan digunakan oleh file lain melalui require/include
?>
