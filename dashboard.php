<?php
session_start(); // Memulai session

// Jika user belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Koneksi database
require_once __DIR__ . '/koneksi.php';

// Helper untuk sanitasi output
function e($str) {
    return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
}

// Handle Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $noplat = trim($_POST['noplat'] ?? '');
    $namapemilik = trim($_POST['namapemilik'] ?? '');
    $jeniskendaraan = $_POST['jeniskendaraan'] ?? 'Mobil';
    $warnakendaraan = trim($_POST['warnakendaraan'] ?? '');
    $keluar_masuk = $_POST['keluar_masuk'] ?? 'Masuk';

    if ($noplat && $namapemilik && $warnakendaraan) {
        $stmt = $conn->prepare("INSERT INTO parkir (noplat, namapemilik, jeniskendaraan, warnakendaraan, keluar_masuk) VALUES (?,?,?,?,?)");
        if ($stmt) {
            $stmt->bind_param('sssss', $noplat, $namapemilik, $jeniskendaraan, $warnakendaraan, $keluar_masuk);
            @$stmt->execute();
            $stmt->close();
        }
    }
    header('Location: dashboard.php');
    exit();
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = (int)($_POST['id'] ?? 0);
    $noplat = trim($_POST['noplat'] ?? '');
    $namapemilik = trim($_POST['namapemilik'] ?? '');
    $jeniskendaraan = $_POST['jeniskendaraan'] ?? 'Mobil';
    $warnakendaraan = trim($_POST['warnakendaraan'] ?? '');
    $keluar_masuk = $_POST['keluar_masuk'] ?? 'Masuk';

    if ($id > 0 && $noplat && $namapemilik && $warnakendaraan) {
        $stmt = $conn->prepare("UPDATE parkir SET noplat=?, namapemilik=?, jeniskendaraan=?, warnakendaraan=?, keluar_masuk=? WHERE id=?");
        if ($stmt) {
            $stmt->bind_param('sssssi', $noplat, $namapemilik, $jeniskendaraan, $warnakendaraan, $keluar_masuk, $id);
            @$stmt->execute();
            $stmt->close();
        }
    }
    header('Location: dashboard.php');
    exit();
}

// Handle Delete (via POST for safety)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = (int)($_POST['id'] ?? 0);
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM parkir WHERE id=?");
        if ($stmt) {
            $stmt->bind_param('i', $id);
            @$stmt->execute();
            $stmt->close();
        }
    }
    header('Location: dashboard.php');
    exit();
}

// Ambil data (Read) + pencarian sederhana
$q = trim($_GET['q'] ?? '');
$items = [];
if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = $conn->prepare("SELECT * FROM parkir WHERE noplat LIKE ? OR namapemilik LIKE ? ORDER BY id DESC");
    if ($stmt) {
        $stmt->bind_param('ss', $like, $like);
        $stmt->execute();
        $res = $stmt->get_result();
        $items = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();
    }
} else {
    $res = $conn->query("SELECT * FROM parkir ORDER BY id DESC");
    if ($res) {
        $items = $res->fetch_all(MYSQLI_ASSOC);
    }
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
        <div class="mb-4">
            <h1 class="h3 mb-1">Halo, <?php echo e($_SESSION['username']); ?> 👋</h1>
            <p class="text-secondary mb-0">Kelola data tempat parkir di bawah ini.</p>
        </div>

        <!-- Alert sederhana jika ada query q -->
        <?php if ($q !== ''): ?>
            <div class="alert alert-info py-2">Hasil pencarian untuk: <strong><?php echo e($q); ?></strong></div>
        <?php endif; ?>

        <div class="row g-4">
            <div class="col-12 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 mb-3">Tambah Data Parkir</h2>
                        <form method="post" class="needs-validation" novalidate>
                            <input type="hidden" name="action" value="create">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="noplat" class="form-label">No. Plat</label>
                                    <input type="text" class="form-control" id="noplat" name="noplat" placeholder="B 1234 CD" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="namapemilik" class="form-label">Nama Pemilik</label>
                                    <input type="text" class="form-control" id="namapemilik" name="namapemilik" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="jeniskendaraan" class="form-label">Jenis Kendaraan</label>
                                    <select class="form-select" id="jeniskendaraan" name="jeniskendaraan">
                                        <option value="Mobil">Mobil</option>
                                        <option value="Motor">Motor</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="warnakendaraan" class="form-label">Warna Kendaraan</label>
                                    <input type="text" class="form-control" id="warnakendaraan" name="warnakendaraan" placeholder="Hitam / Merah" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="keluar_masuk" class="form-label">Status</label>
                                    <select class="form-select" id="keluar_masuk" name="keluar_masuk">
                                        <option value="Masuk">Masuk</option>
                                        <option value="Keluar">Keluar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3 d-grid">
                                <button class="btn btn-primary" type="submit"><i class="bi bi-plus-lg me-1"></i>Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
                            <h2 class="h5 mb-0">Data Parkir</h2>
                            <form class="d-flex" method="get">
                                <input type="text" class="form-control form-control-sm me-2" name="q" value="<?php echo e($q); ?>" placeholder="Cari noplat / pemilik" />
                                <button class="btn btn-outline-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>No. Plat</th>
                                        <th>Pemilik</th>
                                        <th>Jenis</th>
                                        <th>Warna</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($items)): ?>
                                    <tr><td colspan="8" class="text-center text-secondary">Belum ada data</td></tr>
                                <?php else: ?>
                                    <?php foreach ($items as $row): ?>
                                        <tr>
                                            <td><?php echo e($row['id']); ?></td>
                                            <td><?php echo e($row['noplat']); ?></td>
                                            <td><?php echo e($row['namapemilik']); ?></td>
                                            <td><?php echo e($row['jeniskendaraan']); ?></td>
                                            <td><?php echo e($row['warnakendaraan']); ?></td>
                                            <td>
                                                <span class="badge <?php echo $row['keluar_masuk']==='Masuk' ? 'bg-success' : 'bg-secondary'; ?>"><?php echo e($row['keluar_masuk']); ?></span>
                                            </td>
                                            <td class="text-nowrap"><?php echo e($row['created_at']); ?></td>
                                            <td class="text-end">
                                                <!-- Tombol Edit memunculkan modal unik per baris -->
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo e($row['id']); ?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form method="post" class="d-inline" onsubmit="return confirm('Hapus data ini?');">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="id" value="<?php echo e($row['id']); ?>">
                                                    <button class="btn btn-sm btn-outline-danger" type="submit">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal-<?php echo e($row['id']); ?>" tabindex="-1" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title">Edit Data Parkir</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <form method="post">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="id" value="<?php echo e($row['id']); ?>">
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">No. Plat</label>
                                                            <input type="text" class="form-control" name="noplat" value="<?php echo e($row['noplat']); ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Nama Pemilik</label>
                                                            <input type="text" class="form-control" name="namapemilik" value="<?php echo e($row['namapemilik']); ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Jenis Kendaraan</label>
                                                            <select class="form-select" name="jeniskendaraan">
                                                                <?php $opts=['Mobil','Motor','Lainnya']; foreach($opts as $opt): ?>
                                                                    <option value="<?php echo e($opt); ?>" <?php echo $row['jeniskendaraan']===$opt?'selected':''; ?>><?php echo e($opt); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Warna Kendaraan</label>
                                                            <input type="text" class="form-control" name="warnakendaraan" value="<?php echo e($row['warnakendaraan']); ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select" name="keluar_masuk">
                                                                <?php $ops=['Masuk','Keluar']; foreach($ops as $op): ?>
                                                                    <option value="<?php echo e($op); ?>" <?php echo $row['keluar_masuk']===$op?'selected':''; ?>><?php echo e($op); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap Bundle (untuk modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>