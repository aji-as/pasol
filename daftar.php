<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $username     = trim($_POST['username']);
    $password     = $_POST['password'];
    $alamat       = trim($_POST['alamat']);
    $telepon      = trim($_POST['telepon']);
    $role         = 'pembeli';
    $is_cod_allowed = 0;

    if (empty($nama_lengkap) || empty($username) || empty($password) || empty($alamat)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        $hashed_password = md5($password);

        if (create_user($nama_lengkap, $username, $hashed_password, $alamat, $telepon, $role, $is_cod_allowed)) {
            $success = "Pendaftaran berhasil! Silakan masuk.";
            header("refresh:2;url=index.php");
        } else {
            $error = "Pendaftaran gagal. Username mungkin sudah terdaftar atau terjadi kesalahan database.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - PASOL</title>

    <link rel="stylesheet" href="Assets/css/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#FFFFFF',
                        'secondary': '#F7F7F7',
                        'dark': '#000000',
                        'gray-text': '#6B7280',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-secondary text-dark min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-4">
        <div class="bg-white rounded-2xl shadow-lg p-8">

            <!-- HEADER PASOL -->
            <div class="text-center mb-8">
                <a href="index.php" class="inline-flex items-center space-x-2 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-xl">P</span>
                    </div>
                    <span class="text-2xl font-bold text-dark">PASOL</span>
                </a>
                <h1 class="text-2xl font-bold text-dark">Daftar Akun</h1>
            </div>

            <!-- ERROR SUCCESS -->
            <?php if ($error): ?>
                <div class="bg-red-100 w-full text-center mb-5 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <span class="font-medium"><?php echo $error; ?></span>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="bg-green-100 w-full text-center mb-5 border border-green-400 text-green-700 px-4 py-3 rounded">
                    <span class="font-medium"><?php echo $success; ?></span>
                </div>
            <?php endif; ?>

            <!-- FORM -->
            <form method="POST" class="space-y-6">

                <div>
                    <label class="block text-sm font-medium text-dark mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-dark mb-2">Email / Username</label>
                    <input type="text" name="username" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-dark mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-dark mb-2">Alamat Lengkap</label>
                    <input type="text" name="alamat" required placeholder="Blok / Nomor Rumah"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-dark mb-2">Nomor Telepon</label>
                    <input type="text" name="telepon" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>

                <button type="submit"
                    class="w-full py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all duration-300 shadow-md hover:shadow-lg">
                    Daftar
                </button>

            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-text">
                    Sudah punya akun?
                    <a href="login.php" class="text-green-600 font-medium hover:underline">Masuk di sini</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>