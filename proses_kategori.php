<?php
include 'koneksitugas.php';

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $nama_kategori = $_POST['nama_kategori'];
        $keterangan = $_POST['keterangan'];

        // Query INSERT
        $query = "INSERT INTO kategori (nama_kategori, keterangan) VALUES (?, ?)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("ss", $nama_kategori, $keterangan);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=kategori");
        } else {
            echo "Data Kategori Gagal Disimpan" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id_kategori = $_POST['id_kategori'];
        $nama_kategori = $_POST['nama_kategori'];
        $keterangan = $_POST['keterangan'];

        // Query UPDATE
        $query = "UPDATE kategori SET nama_kategori=?, keterangan=? WHERE id_kategori=?";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("ssi", $nama_kategori, $keterangan, $id_kategori);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=kategori");
        } else {
            echo "Data Kategori Gagal Diupdate" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

if ($_GET['proses'] == 'delete') {
    if (isset($_GET['id'])) {
        $id_kategori = $_GET['id'];
        $sql = "DELETE FROM kategori WHERE id_kategori='$id_kategori'";

        if ($db->query($sql) == TRUE) {
            Header("Location: index.php?page=kategori");
        } else {
            echo "Gagal Hapus Kategori!" . $db->error;
        }
    } else {
        echo "ID Kategori TIDAK DITEMUKAN!";
    }
}
?>
