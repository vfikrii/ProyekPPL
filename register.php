<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
        <h2 class="text-3xl font-bold text-center text-white mb-6">Register</h2>
        <form method="post" action="" onsubmit="return validatePassword()">
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
            <div class="mb-4">
                <div class="relative">
                    <input type="email" name="email" id="email" class="w-full p-3 pl-10 bg-transparent border border-white rounded-full text-white placeholder-white focus:outline-none" placeholder="Email" required>
                    <i class="fas fa-envelope absolute left-3 top-3 text-white"></i>
                </div>
            </div>
            <button type="submit" class="w-full py-3 bg-white text-green-900 rounded-full font-bold">Register</button>
        </form>
    </div>

    <script>
        function validatePassword() {
            const password = document.getElementById('password').value;
            const passwordRegex = /^(?=.*[A-Z]).{8,}$/; // Minimal 8 karakter dan 1 huruf kapital

            if (!passwordRegex.test(password)) {
                alert('Password harus memiliki minimal 8 karakter dan setidaknya satu huruf kapital.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
