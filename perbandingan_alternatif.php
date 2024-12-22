<?php
    include('config.php');
    include('fungsi.php');
    include('navbar.php');

    // Menyimpan perbandingan kriteria jika ada data POST
    if (isset($_POST['submit'])) {
        // Loop untuk semua perbandingan kriteria
        foreach ($_POST['kriteria'] as $k1 => $row) {
            foreach ($row as $k2 => $value) {
                // Jika tidak ada nilai yang dipilih, set nilai default 1
                if ($value == 0) {
                    $value = 1;
                }
                // Simpan ke database (tabel `perbandingan_kriteria` misalnya)
                $query = "REPLACE INTO perbandingan_kriteria (kriteria1, kriteria2, nilai) VALUES ('$k1', '$k2', '$value')";
                if (!mysqli_query($conn, $query)) {
                    echo "Error: " . mysqli_error($conn);  // Menampilkan error jika ada masalah query
                }
            }
        }

        // Redirect ke halaman bobot.php setelah data berhasil disimpan
        header('Location: bobot_kriteria.php');
        exit();
    }

    // Ambil data kriteria
    $query = "SELECT id, nama FROM kriteria ORDER BY id";
    $result = mysqli_query($conn, $query);
    $kriteria = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $kriteria[$row['id']] = $row['nama'];
    }

    // Ambil data perbandingan kriteria jika ada
    $query = "SELECT * FROM perbandingan_kriteria";
    $result = mysqli_query($conn, $query);
    $perbandingan = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $perbandingan[$row['kriteria1']][$row['kriteria2']] = $row['nilai'];
    }
?>

<section class="content container mt-5">
    <h2 class="ui header">Perbandingan Kriteria</h2>
    <form method="post" action="bobot_kriteria.php">
        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Kriteria 1</th>
                    <th>Nilai Perbandingan</th>
                    <th>Kriteria 2</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kriteria as $id1 => $nama1): ?>
                    <?php foreach ($kriteria as $id2 => $nama2): ?>
                        <?php if ($id1 < $id2): ?>
                            <tr>
                                <td><?php echo $nama1; ?></td>
                                <td>
                                    <select name="kriteria[<?php echo $id1; ?>][<?php echo $id2; ?>]" class="ui dropdown">
                                        <option value="0" <?php echo !isset($perbandingan[$id1][$id2]) ? 'selected' : ''; ?>>Pilih</option>
                                        <option value="1" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 1) ? 'selected' : ''; ?>>1 - Sama penting</option>
                                        <option value="3" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 3) ? 'selected' : ''; ?>>3 - Sedikit lebih penting</option>
                                        <option value="5" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 5) ? 'selected' : ''; ?>>5 - Lebih penting</option>
                                        <option value="7" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 7) ? 'selected' : ''; ?>>7 - Jauh lebih penting</option>
                                        <option value="9" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 9) ? 'selected' : ''; ?>>9 - Mutlak lebih penting</option>
                                        <option value="0.333" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 0.333) ? 'selected' : ''; ?>>1/3 - Sedikit kurang penting</option>
                                        <option value="0.2" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 0.2) ? 'selected' : ''; ?>>1/5 - Kurang penting</option>
                                        <option value="0.143" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 0.143) ? 'selected' : ''; ?>>1/7 - Jauh kurang penting</option>
                                        <option value="0.111" <?php echo (isset($perbandingan[$id1][$id2]) && $perbandingan[$id1][$id2] == 0.111) ? 'selected' : ''; ?>>1/9 - Sangat kurang penting</option>
                                    </select>
                                </td>
                                <td><?php echo $nama2; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <button type="submit" name="submit" class="ui button primary">Simpan Perbandingan</button>
    </form>
</section>
