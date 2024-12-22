<?php
session_start();
include 'config.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'guest') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-logout {
            background: none;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            font-weight: bold;
            color: #000;
        }

        .btn-logout:hover {
            background-color: #f8f9fa;
            color: #007bff;
            border-radius: 4px;
        }

        /* Hero Section */
        .hero-image {
            width: 100%;
            height: 100vh;
            background-image: url('userimage.jpg');
            background-position: center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .hero-overlay h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .hero-overlay p {
            font-size: 1rem;
            max-width: 700px;
            margin: 20px 0;
        }

        .hero-overlay .btn-mulai {
            margin-top: 20px;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: bold;
            background-color: #ffffff;
            color: #000;
            border-radius: 30px;
            text-decoration: none;
        }

        .hero-overlay .btn-mulai:hover {
            background-color: #1A1A1D;
            color: white;
        }

        /* Footer */
        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .hero-image {
                height: 70vh; /* Kurangi tinggi untuk perangkat kecil */
            }

            .hero-overlay h1 {
                font-size: 1.8rem;
            }

            .hero-overlay p {
                font-size: 0.9rem;
            }

            .hero-overlay .btn-mulai {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .hero-overlay h1 {
                font-size: 1.5rem;
            }

            .hero-overlay p {
                font-size: 0.8rem;
            }

            .hero-overlay .btn-mulai {
                padding: 8px 15px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Guest Homepage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="homeguest.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="pilih_kriteria.php">Pemilihan Kriteria</a></li>
                    <li class="nav-item"><a class="nav-link" href="rekomendasi.php">Rekomendasi</a></li>
                    <li class="nav-item">
                        <form method="post" action="logout.php">
                            <button class="btn-logout" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-image">
        <div class="hero-overlay">
            <h1>Selamat Datang di Sistem Pemilihan Destinasi Wisata Kota Medan</h1>
            <p>Temukan destinasi wisata terbaik di Kota Medan dengan menggunakan sistem pemilihan berbasis AHP. Pilih destinasi yang sesuai dengan preferensimu dan temukan pengalaman liburan yang luar biasa.</p>
            <a href="pilih_kriteria.php" class="btn-mulai">Lihat Data</a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>Copyright © 2024 - Created by Kelompok 2 - Fikri Shelmu Aqsal</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

