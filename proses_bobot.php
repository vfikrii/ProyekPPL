<?php
include('config.php');

// Pastikan data bobot ada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bobot'])) {
    $bobot = $_POST['bobot'];

    // Cek apakah data bobot valid
    if (empty($bobot)) {
        echo json_encode(['status' => 'error', 'message' => 'Data bobot tidak ditemukan']);
        exit();
    }

    // Proses penyimpanan bobot per kriteria
    foreach ($bobot as $kriteria_id => $nilai_bobot) {
        // Validasi bobot harus berupa angka
        if (is_numeric($nilai_bobot) && $nilai_bobot >= 0 && $nilai_bobot <= 100) {
            // Pastikan kriteria_id adalah integer
            $kriteria_id = (int)$kriteria_id;
            $nilai_bobot = mysqli_real_escape_string($conn, $nilai_bobot);

            // Debugging: Cek nilai yang akan digunakan
            // echo "kriteria_id: $kriteria_id, nilai_bobot: $nilai_bobot"; exit;

            // Query untuk update bobot kriteria
            $query = "UPDATE kriteria SET bobot = '$nilai_bobot' WHERE id = $kriteria_id";
            if (!mysqli_query($conn, $query)) {
                // Jika query gagal
                echo json_encode(['status' => 'error', 'message' => 'Error updating record: ' . mysqli_error($conn)]);
                exit();
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Bobot tidak valid']);
            exit();
        }
    }

    // Jika berhasil
    echo json_encode(['status' => 'success', 'message' => 'Bobot berhasil disimpan']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
