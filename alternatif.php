<head>
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        // Fungsi untuk menghapus alternatif
        function deleteAlternatif(id) {
            if (confirm('Apakah Anda yakin ingin menghapus alternatif ini?')) {
                $.ajax({
                    url: 'alternatif.php',
                    type: 'POST',
                    data: { action: 'delete', id: id },
                    success: function(response) {
                        // Hapus baris tabel secara dinamis jika delete berhasil
                        $('#row-' + id).remove();
                        alert('Alternatif berhasil dihapus.');
                    },
                    error: function() {
                        alert('Gagal menghapus alternatif. Silakan coba lagi.');
                    }
                });
            }
        }

        // Fungsi untuk mengedit alternatif
        function toggleEditForm(id) {
            const editForm = $('#edit-form-' + id);
            const displayName = $('#name-' + id);

            if (editForm.is(':visible')) {
                // Sembunyikan form edit, tampilkan nama
                editForm.hide();
                displayName.show();
            } else {
                // Tampilkan form edit, sembunyikan nama
                editForm.show();
                displayName.hide();
            }
        }

        // Fungsi untuk menambahkan alternatif
        function addAlternatif() {
            const newAlternatifName = $('#new-alternatif-name').val();
            if (newAlternatifName) {
                $.ajax({
                    url: 'alternatif.php',
                    type: 'POST',
                    data: { action: 'add', name: newAlternatifName },
                    success: function(response) {
                        location.reload(); // Refresh halaman untuk melihat data baru
                    },
                    error: function() {
                        alert('Gagal menambahkan alternatif. Silakan coba lagi.');
                    }
                });
            } else {
                alert('Nama alternatif tidak boleh kosong.');
            }
        }

        // Fungsi untuk mengupdate alternatif
        function updateAlternatif(id) {
            const newName = $('#edit-name-' + id).val();
            if (newName) {
                $.ajax({
                    url: 'alternatif.php',
                    type: 'POST',
                    data: { action: 'update', id: id, name: newName },
                    success: function(response) {
                        location.reload(); // Refresh halaman untuk menampilkan perubahan
                    },
                    error: function() {
                        alert('Gagal mengupdate alternatif. Silakan coba lagi.');
                    }
                });
            } else {
                alert('Nama alternatif tidak boleh kosong.');
            }
        }
    </script>
</head>

<?php
    include('config.php');
    include('fungsi.php');

    // Proses CRUD berdasarkan action (dengan metode POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            // Tambah Alternatif
            if ($action === 'add' && isset($_POST['name'])) {
                $name = $_POST['name'];
                $query = "INSERT INTO alternatif (nama) VALUES ('$name')";
                mysqli_query($conn, $query);
                exit(); // Berhenti setelah proses selesai
            }

            // Update Alternatif
            if ($action === 'update' && isset($_POST['id']) && isset($_POST['name'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $query = "UPDATE alternatif SET nama = '$name' WHERE id = $id";
                mysqli_query($conn, $query);
                exit();
            }

            // Hapus Alternatif
            if ($action === 'delete' && isset($_POST['id'])) {
                $id = $_POST['id'];
                $query = "DELETE FROM alternatif WHERE id = $id";
                mysqli_query($conn, $query);
                exit();
            }
        }
    }

    // Menampilkan data alternatif
    $query = "SELECT id, nama FROM alternatif ORDER BY id";
    $result = mysqli_query($conn, $query);
    include('navbar.php');
?>

<section class="content container mt-5">
    <h2 class="ui header">Alternatif</h2>
    
    <table class="ui celled table">
        <thead>
            <tr>
                <th class="collapsing">No</th>
                <th>Nama Alternatif</th>
                <th class="collapsing">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $i++;
        ?>
            <tr id="row-<?php echo $row['id'] ?>">
                <td><?php echo $i ?></td>
                <td>
                    <span id="name-<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></span>

                    <!-- Form Edit -->
                    <form id="edit-form-<?php echo $row['id'] ?>" style="display: none;">
                        <input type="text" id="edit-name-<?php echo $row['id'] ?>" value="<?php echo $row['nama'] ?>" required>
                        <button type="button" onclick="updateAlternatif(<?php echo $row['id'] ?>)" class="ui mini green button">Update</button>
                    </form>
                </td>
                <td>
                    <!-- Tombol Edit -->
                    <button type="button" onclick="toggleEditForm(<?php echo $row['id'] ?>)" class="ui mini teal button">
                        Edit
                    </button>

                    <!-- Tombol Delete -->
                    <button type="button" onclick="deleteAlternatif(<?php echo $row['id'] ?>)" class="ui mini red button">
                        Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot class="full-width">
            <tr>
                <th colspan="3">
                    <input type="text" id="new-alternatif-name" placeholder="Nama Alternatif" required>
                    <button type="button" onclick="addAlternatif()" class="ui right floated small primary labeled icon button">
                        <i class="plus icon"></i>Tambah
                    </button>
                </th>
            </tr>
        </tfoot>
    </table>

    <br>

    <form action="bobot_kriteria.php">
        <button class="ui right labeled icon button" style="float: right;">
            <i class="right arrow icon"></i>
            Lanjut
        </button>
    </form>
</section>
