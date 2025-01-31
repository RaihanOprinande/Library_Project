<?php
include 'koneksitugas.php';
$tanggal_kunjungan_default = date("Y-m-d");
if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $id_member = $_POST['id_member'];
        $jurusan_id = $_POST['jurusan_id'];
        $prodi_id = $_POST['prodi_id'];

        // Gabungkan tanggal pendaftaran
        $tanggal_kunjungan = $tanggal_kunjungan_default;

        // Query INSERT dengan penanganan nilai foto
        $query = "INSERT INTO kunjungan (id_member, jurusan_id, prodi_id, tanggal_kunjungan) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("siis", $id_member, $jurusan_id, $prodi_id, $tanggal_kunjungan);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=visitor&aksi=list");
        } else {
            echo "Data Gagal Disimpan" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}