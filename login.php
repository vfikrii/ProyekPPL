<?php
session_start(); // Harus berada di baris pertama sebelum ada output apa pun
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: index.php");
        } else {
            header("Location: homeguest.php");
        }
    } else {
        $_SESSION['error'] = "Username atau password salah!";
        header("Location: login.php");
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .overlay {
            background-color: rgba(34, 139, 34, 0.7); /* Shadow green overlay */
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-green-900">
    <div class="bg-white bg-opacity-10 p-8 rounded-lg shadow-lg backdrop-blur-md w-96 overlay">
        <h2 class="text-3xl font-bold text-center text-white mb-6">Login</h2>
        <form method="post" action="">
            <div class="mb-4">
                <div class="relative">
                    <input type="text" name="username" id="username" class="w-full p-3 pl-10 bg-transparent border border-white rounded-full text-white placeholder-white focus:outline-none" placeholder="Username" required>
                    <i class="fas fa-user absolute left-3 top-3 text-white"></i>
                </div>
            </div>
            <div class="mb-4">
                <div class="relative">
                    <input type="password" name="password" id="password" class="w-full p-3 pl-10 bg-transparent border border-white rounded-full text-white placeholder-white focus:outline-none" placeholder="Password" required>
                    <i class="fas fa-lock absolute left-3 top-3 text-white"></i>
                </div>
            </div>
            <button type="submit" class="w-full py-3 bg-white text-green-900 rounded-full font-bold">Login</button>
        </form>
        <p class="text-center text-white mt-6">Belum punya akun? <a href="register.php" class="font-bold">Register</a></p>
        <p class="text-center text-white bg-green-800 bg-opacity-80 p-3 rounded mt-4">
            <strong>Gunakan Mode Desktop</strong> untuk hasil yang maksimal.
        </p>
    </div>

    <!-- JavaScript untuk Notifikasi -->
    <script>
        // Tampilkan notifikasi jika error ada di session
        <?php if (isset($_SESSION['error'])): ?>
            alert('<?php echo $_SESSION['error']; ?>');
            <?php unset($_SESSION['error']); // Hapus error dari session setelah ditampilkan ?>
        <?php endif; ?>
    </script>
</body>
</html>