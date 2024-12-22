<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSS | AHP</title>
    <style>
        /* Umum untuk body */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-x: hidden;
        }

        /* Kontainer utama */
        .main-container {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        /* Konten Atas (Gambar) */
        .top-content {
            width: 100%;
            height: 100vh;
            background: url('ahp.jpg') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .top-content h2 {
            font-weight: bold;
            color: #f4f4f4;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        /* Footer Styling */
        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }

        /* Tambahkan Media Query untuk Responsif */
        @media (max-width: 1024px) {
            .top-content {
                height: 80vh; /* Kurangi tinggi pada tablet */
                padding: 15px;
            }

            .top-content h2 {
                font-size: 24px; /* Kecilkan font */
                margin-bottom: 15px;
            }

            footer {
                font-size: 14px; /* Ukuran teks lebih kecil */
            }
        }

        @media (max-width: 768px) {
            .top-content {
                height: 70vh; /* Kurangi lebih banyak tinggi pada ponsel */
                padding: 10px;
            }

            .top-content h2 {
                font-size: 20px;
                letter-spacing: 1px; /* Sesuaikan jarak huruf */
            }
        }

        @media (max-width: 480px) {
            .top-content {
                height: 60vh; /* Tinggi lebih kecil pada layar kecil */
                padding: 5px;
                text-align: left; /* Sesuaikan tata letak */
            }

            .top-content h2 {
                font-size: 18px;
                margin-bottom: 10px;
            }

            footer {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <?php include 'fungsi.php'; ?>
    <?php include 'navbar.php'; ?>

    <!-- Konten -->
    <div class="main-container">
        <div class="top-content">
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>Copyright © 2024 - Created by Kelompok 2 - Fikri Shelmu Aqsal</p>
    </footer>
</body>
</html>
