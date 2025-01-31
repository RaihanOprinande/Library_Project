<?php
include 'koneksitugas.php';

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $nama_pengarang = $_POST['nama_pengarang'];
        $keterangan = $_POST['keterangan'];

        // Query INSERT
        $query = "INSERT INTO pengarang (nama_pengarang, keterangan) VALUES (?, ?)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("ss", $nama_pengarang, $keterangan);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=pengarang");
        } else {
            echo "Data Pengarangi Gagal Disimpan" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id_pengarang = $_POST['id_pengarang'];
        $nama_pengarang = $_POST['nama_pengarang'];
        $keterangan = $_POST['keterangan'];

        // Query UPDATE
        $query = "UPDATE pengarang SET nama_pengarang=?, keterangan=? WHERE id_pengarang=?";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("ssi", $nama_pengarang, $keterangan, $id_pengarang);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=pengarang");
        } else {
            echo "Data Pengarang Gagal Diupdate" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

if ($_GET['proses'] == 'delete') {
    if (isset($_GET['id'])) {
        $id_pengarang = $_GET['id'];
        $sql = "DELETE FROM pengarang WHERE id_pengarang='$id_pengarang'";

        if ($db->query($sql) == TRUE) {
            Header("Location: index.php?page=pengarang");
        } else {
            echo "Gagal Hapus Pengarang!" . $db->error;
        }
    } else {
        echo "ID Pengarang TIDAK DITEMUKAN!";
    }
}
?>
