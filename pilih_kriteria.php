<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Perangkingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        /* Menggunakan Flexbox agar konten utama mengisi ruang dan footer tetap di bawah */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('userimage.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10; /* Agar navbar tetap di atas */
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
            background-color: #f8f9fa; /* Latar belakang terang saat hover */
            color: #007bff; /* Mengubah warna teks saat hover */
            border-radius: 4px; /* Memberikan efek rounded pada hover */
        }

        .btn-logout:focus {
            outline: none; /* Menghilangkan outline saat tombol di-klik */
        }

        .ranking-header {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: black;
            margin: 30px 0;
        }

        .ranking-table {
            width: 100%;
            margin: 20px auto;
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
            color: #28a745;
        }

        /* Footer Styling */
        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 20px 0; /* Meningkatkan padding untuk tinggi footer */
            position: relative;
            width: 100%;
            z-index: 1;
            margin-top: auto; /* Pastikan footer berada di bawah konten */
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

    <!-- Content -->
    <section class="container mt-5">
        <h2 class="ranking-header"></h2>
        <table class="table table-bordered ranking-table">
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Alternatif</th>
                    <th>Nilai Total</th>
                    <th>Keunggulan pada Kriteria</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('config.php');
                include('fungsi.php');

                $jmlKriteria = getJumlahKriteria();
                $jmlAlternatif = getJumlahAlternatif();
                $nilai = array();

                for ($x = 0; $x <= ($jmlAlternatif - 1); $x++) {
                    $nilai[$x] = 0;
                    for ($y = 0; $y <= ($jmlKriteria - 1); $y++) {
                        $id_alternatif = getAlternatifID($x);
                        $id_kriteria = getKriteriaID($y);

                        $pv_alternatif = getAlternatifPV($id_alternatif, $id_kriteria);
                        $pv_kriteria = getKriteriaPV($id_kriteria);

                        $nilai[$x] += ($pv_alternatif * $pv_kriteria);
                    }
                }

                for ($i = 0; $i <= ($jmlAlternatif - 1); $i++) {
                    $id_alternatif = getAlternatifID($i);
                    $query = "INSERT INTO ranking VALUES ($id_alternatif, $nilai[$i]) ON DUPLICATE KEY UPDATE nilai=$nilai[$i]";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        echo "Gagal mengupdate ranking";
                        exit();
                    }
                }

                $query = "SELECT id, nama, id_alternatif, nilai FROM alternatif, ranking WHERE alternatif.id = ranking.id_alternatif ORDER BY nilai DESC";
                $result = mysqli_query($conn, $query);

                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $i++;
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . round($row['nilai'], 5) . "</td>";

                    $keunggulan = [];
                    for ($y = 0; $y < $jmlKriteria; $y++) {
                        $id_kriteria = getKriteriaID($y);
                        $pv_alternatif = getAlternatifPV($row['id_alternatif'], $id_kriteria);
                        $pv_kriteria = getKriteriaPV($id_kriteria);

                        if ($pv_alternatif > $pv_kriteria) {
                            $keunggulan[] = getKriteriaNama($y);
                        }
                    }

                    if (count($keunggulan) > 0) {
                        echo "<td class='keunggulan'>" . implode(", ", $keunggulan) . "</td>";
                    } else {
                        echo "<td>-</td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>Copyright © 2024 - Created by Kelompok 2 - Fikri Shelmu Aqsal</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6vDsOH1A6RWaaW2xxr2n3oz1RSK6eUbGln/ll8zdf1QId4nsE5z" crossorigin="anonymous"></script>
</body>
</html>
