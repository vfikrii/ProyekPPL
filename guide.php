<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSS | AHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Montserrat:wght@500&family=PT+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Josefin Sans', sans-serif;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 20px;
        }

        .main-home {
            text-align: left;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .main-home h2 {
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            color: #f4f4f4;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .main-home hr {
            width: 60%;
            margin: 20px auto;
            border-top: 3px solid #7ed957;
        }

        .main-home ol {
            padding-left: 20px;
        }

        .main-home ul {
            padding-left: 40px;
            list-style-type: circle;
        }

        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            width: 100%;
            z-index: 1;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <?php include 'fungsi.php'; ?>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="main-home">
            <h2>Tata Cara Penggunaan Website SPK Pemilihan Wisata Kota Medan</h2>
            <p>
                <strong>Web SPK Pemilihan Destinasi Kota Medan</strong> adalah website yang berisikan algoritma SPK AHP yang berfungsi untuk mempermudah turis atau pengunjung dari luar kota Medan untuk memilih lokasi wisata yang cocok dengan kriteria milik mereka.
                Pengunjung mendapatkan kemudahan untuk mengisi, mengubah, dan melihat pemeringkatan lokasi wisata berdasarkan kriteria yang mereka masukkan.
            </p>
            <hr>
            <ol>
                <li>
                    <strong>Halaman Kriteria</strong>
                    <ul>
                        <li>Klik tombol "Kriteria" pada bagian navigation bar.</li>
                        <li>Klik tombol "Tambah".</li>
                        <li>Masukkan kriteria yang diinginkan.</li>
                    </ul>
                </li>
                <li>
                    <strong>Halaman Alternatif</strong>
                    <ul>
                        <li>Klik tombol "Lanjut" pada pojok kanan bawah halaman Kriteria atau tombol "Alternatif" pada navigation bar.</li>
                        <li>Klik tombol "Tambah".</li>
                        <li>Masukkan alternatif yang diinginkan.</li>
                    </ul>
                </li>
                <li>
                    <strong>Halaman Perbandingan Kriteria</strong>
                    <ul>
                        <li>Klik tombol "Lanjut" pada pojok kanan bawah halaman Kriteria atau tombol "Alternatif" pada navigation bar.</li>
                        <li>Masukkan nilai perbandingan dari kriteria yang telah dimasukkan sebelumnya.</li>
                        <li>Gunakan fitur radio button dan up/down button untuk mempermudah pemasukan nilai perbandingan.</li>
                        <li>Klik tombol "Submit" untuk memasukkan nilai ke perhitungan sistem.</li>
                        <li>Sistem akan mengarahkan pengunjung ke tabel matriks perbandingan dan nilai kriteria.</li>
                    </ul>
                </li>
                <li>
                    <strong>Halaman Perbandingan Alternatif</strong>
                    <ul>
                        <li>Setelah selesai melihat tabel, klik tombol "Lanjut".</li>
                        <li>Masukkan nilai perbandingan dari alternatif sesuai tiap kriteria yang telah dimasukkan sebelumnya.</li>
                        <li>Gunakan fitur radio button dan up/down button untuk mempermudah pemasukan nilai perbandingan.</li>
                        <li>Klik tombol "Submit" untuk memasukkan nilai ke perhitungan sistem.</li>
                        <li>Sistem akan menampilkan tabel perbandingan dan nilai alternatif.</li>
                    </ul>
                </li>
                <li>
                    <strong>Halaman Ranking</strong>
                    <ul>
                        <li>Halaman ini akan menampilkan tabel hasil perhitungan dan pemeringkatan alternatif.</li>
                        <li>Peringkat paling atas diisi oleh alternatif dengan nilai total tertinggi dari bobot nilai tiap kriteria.</li>
                    </ul>
                </li>
            </ol>
        </div>
    </div>

    <footer>
        <p>Copyright © 2024 - Created by Kelompok 2 - Fikri Shelmu Aqsal</p>
    </footer>
</body>
</html>
