<?php
include 'koneksitugas.php';
if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        
        $nama_jurusan = $_POST['nama_jurusan'];
       

        // Query INSERT dengan penanganan nilai foto
        $query = "INSERT INTO jurusan (nama_jurusan) VALUES (?)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("s", $nama_jurusan);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=jurusan&aksi=list");
        } else {
            echo "Data Gagal Disimpan" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        // Mendapatkan nilai id dari formulir
        $id = $_POST['id'];
        $nama_jurusan = $_POST['nama_jurusan'];

        // Query UPDATE dengan penanganan nilai foto
        $query = "UPDATE jurusan SET nama_jurusan=? WHERE id=?";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("si", $nama_jurusan, $id);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=jurusan");
        } else {
            echo "Data Gagal Diupdate: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}


if ($_GET['proses'] == 'delete') {
    //query delete
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM jurusan WHERE id='$id'";

        if ($db->query($sql) == TRUE) {
            Header("Location: index.php?page=jurusan");
        } else {
            echo "Gagal Update!" . $db->error;
        }
    } else {
        echo "ID TIDAK DITEMUKAN!";
    }
}
?>
