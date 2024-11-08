<?php
include 'koneksitugas.php';

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $nama_penerbit = $_POST['nama_penerbit'];
        $keterangan = $_POST['keterangan'];

        // Query INSERT
        $query = "INSERT INTO penerbit (nama_penerbit, keterangan) VALUES (?, ?)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("ss", $nama_penerbit, $keterangan);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=penerbit");
        } else {
            echo "Data Penerbit Gagal Disimpan" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id_penerbit = $_POST['id_penerbit'];
        $nama_penerbit = $_POST['nama_penerbit'];
        $keterangan = $_POST['keterangan'];

        // Query UPDATE
        $query = "UPDATE penerbit SET nama_penerbit=?, keterangan=? WHERE id_penerbit=?";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("ssi", $nama_penerbit, $keterangan, $id_penerbit);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=penerbit");
        } else {
            echo "Data Penerbit Gagal Diupdate" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

if ($_GET['proses'] == 'delete') {
    if (isset($_GET['id'])) {
        $id_penerbit = $_GET['id'];
        $sql = "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'";

        if ($db->query($sql) == TRUE) {
            Header("Location: index.php?page=penerbit");
        } else {
            echo "Gagal Hapus Penerbit!" . $db->error;
        }
    } else {
        echo "ID Penerbit TIDAK DITEMUKAN!";
    }
}
?>
