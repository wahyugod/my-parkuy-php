<?php
session_start(); // Memulai session

// Jika user sudah login, redirect ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error = ''; // Variabel untuk menyimpan pesan error

// Cek jika form disubmit menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Autentikasi sederhana (gantilah dengan validasi dari database di aplikasi nyata)
    if ($username === 'admin' && $password === 'admin') {
        // Jika login berhasil, simpan username ke session
        $_SESSION['username'] = $username;
        // Redirect ke halaman dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika login gagal
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - My Parkuy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f1f5f9;
        }
        .login-card {
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="card login-card shadow-sm">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <img src="assets/img/logo.png" alt="Logo My Parkuy" width="40" class="mb-2" />
                <h1 class="h3 mb-3 fw-normal">Silakan Login</h1>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <div class="text-center mt-3">
                <a href="index.php">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>