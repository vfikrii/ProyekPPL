<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            color: #333;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .nav-link, .btn-logout {
            color: #000;
        }

        .nav-link:hover, .btn-logout:hover {
            color: #555;
        }

        .btn-logout {
            background: none;
            border: none;
            font-size: 16px;
            padding: 8px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: bold;
        }

        .btn-logout:hover {
            background-color: #f8f9fa;
            color: #007bff;
            border-radius: 4px;
        }

        .hero-image {
            width: 100%;
            height: 100vh;
            background-image: url('userimage.jpg');
            background-position: center center;
            background-size: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            z-index: 1;
        }

        .hero-overlay h1 {
            font-size: 48px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
        }

        .hero-overlay p {
            font-size: 20px;
            text-align: center;
            max-width: 700px;
            line-height: 1.5;
            margin-top: 20px;
            font-weight: 300;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
        }

        .container {
            padding: 20px;
            text-align: center;
            z-index: 2;
        }

        .ranking-table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .ranking-table th,
        .ranking-table td {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
        }

        .ranking-table th {
            background-color: #ffffff;
            color: black;
            font-size: 18px;
            font-weight: bold;
        }

        .ranking-table td {
            background-color: #ffffff;
            font-size: 16px;
            color : #333;
        }

        .ranking-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .ranking-table tr:hover {
            background-color: #e9ecef;
            cursor: pointer;
        }

        .keunggulan {
            font-style: italic;
            color: #000;
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
                    <li class="nav-item">
                        <a class="nav-link" href="homeguest.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pilih_kriteria.php">Pemilihan Kriteria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rekomendasi.php">Rekomendasi</a>
                    </li>
                    <li class="nav-item">
                        <form method="post" action="logout.php" style="display: inline;">
                            <button class="btn-logout" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Image Section -->
    <div class="hero-image">
        <div class="hero-overlay">
            <h1>Rekomendasi Destinasi Wisata Anda</h1>
            <p>Temukan destinasi wisata terbaik di Kota Medan berdasarkan preferensi Anda.</p>
        </div>
    </div>

    <!-- Content -->
    <section class="container mt-5">
        <h2 class="ranking-header"></h2>
        <table class="table table-bordered ranking-table">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Alternatif</th>
                    <th>Kesimpulan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data rekomendasi bisa dimasukkan di sini menggunakan PHP -->
                <?php
                include('config.php');
                include('fungsi.php');

                // Menghitung jumlah alternatif
                $query_jmlAlternatif = "SELECT COUNT(*) as total FROM alternatif";
                $result_jmlAlternatif = mysqli_query($conn, $query_jmlAlternatif);
                $row_jmlAlternatif = mysqli_fetch_assoc($result_jmlAlternatif);
                $jmlAlternatif = $row_jmlAlternatif['total'];

                $jmlKriteria = getJumlahKriteria();
                $query = "SELECT id, nama, id_alternatif, nilai FROM alternatif, ranking WHERE alternatif.id = ranking.id_alternatif ORDER BY nilai DESC";
                $result = mysqli_query($conn, $query);

                $rank = 1;
                while ($row = mysqli_fetch_array($result)) {
                    $nama = $row['nama'];

                    // Mendapatkan keunggulan kriteria
                    $keunggulan = [];
                    for ($y = 0; $y < $jmlKriteria; $y++) {
                        $id_kriteria = getKriteriaID($y);
                        $pv_alternatif = getAlternatifPV($row['id_alternatif'], $id_kriteria);
                        $pv_kriteria = getKriteriaPV($id_kriteria);

                        if ($pv_alternatif > $pv_kriteria) {
                            $keunggulan[] = getKriteriaNama($y);
                        }
                    }
                    $keunggulan_str = count($keunggulan) > 0 ? implode(", ", $keunggulan) : "tidak ada keunggulan khusus";

                    // Kesimpulan berdasarkan peringkat
                    $kesimpulan = "";
                    switch ($rank) {
                        case 1:
                            $kesimpulan = "Tempat wisata ini menempati peringkat 1 karena unggul di banyak kriteria yang Anda berikan seperti: $keunggulan_str.";
                            break;
                        case 2:
                            $kesimpulan = "Tempat wisata ini menduduki peringkat 2 dengan kecocokan kriteria Anda, unggul pada bagian: $keunggulan_str.";
                            break;
                        case 3:
                            $kesimpulan = "Tempat wisata ini berada di peringkat 3 masih tergolong cocok dengan penilaian Anda pada kriteria: $keunggulan_str.";
                            break;
                        default:
                            if ($rank <= $jmlAlternatif / 2) {
                                $kesimpulan = "Tempat wisata ini menempati peringkat $rank, dan meskipun kurang unggul dibandingkan pilihan lain, tetap memiliki keunggulan pada bagian: $keunggulan_str.";
                            } else {
                                $kesimpulan = "Tempat wisata ini menduduki peringkat $rank dan hanya unggul di bagian: $keunggulan_str, sehingga kurang cocok dengan preferensi Anda.";
                            }
                            break;
                    }

                    // Output tabel
                    echo "<tr>";
                    echo "<td>$rank</td>";
                    echo "<td>$nama</td>";
                    echo "<td>$kesimpulan</td>";
                    echo "</tr>";

                    $rank++;
                }
                ?>
            </tbody>
        </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybS+P2L9pEx5Vf6Xy3yY2g5ITt1vVo8QME15f5C9R6NboF6iy5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0f4zYwOp7zZldqpb8NjP9uHg74lxK7+Mr0g9On5Se7fb79p" crossorigin="anonymous"></script>
</body>
</html>
