<?php
include 'koneksitugas.php';


if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $kode_buku = $_POST['kode_buku'];
        $judul = $_POST['judul'];
        $category_id = $_POST['category_id'];
        $pengarang_id = $_POST['pengarang_id'];
        $penerbit_id = $_POST['penerbit_id'];
        $total_books = $_POST['total_books'];
        $sinopsis = $_POST['sinopsis'];

        // Check if kode_buku already exists
        $queryCheckExisting = "SELECT id FROM buku WHERE kode_buku=?";
        $stmtCheckExisting = $db->prepare($queryCheckExisting);
        $stmtCheckExisting->bind_param("s", $kode_buku);
        $stmtCheckExisting->execute();
        $stmtCheckExisting->store_result();

        if ($stmtCheckExisting->num_rows > 0) {
            echo "Kode Buku sudah ada";
            exit; // Stop further processing
        }
        

        // Periksa apakah gambar diupload
        $gambar_path = '';
        if (isset($_FILES['gambar']['tmp_name']) && !empty($_FILES['gambar']['tmp_name'])) {
            $gambar_name = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];

            // Sesuaikan folder tempat gambar disimpan
            $folder_path = "images/";

            // Sesuaikan path gambar dengan nama folder dan nama file
            $gambar_path = $folder_path . $gambar_name;

            move_uploaded_file($gambar_tmp, $gambar_path);
        }

        // Query INSERT dengan penanganan nilai gambar
        $query = "INSERT INTO buku (kode_buku, judul, category_id, pengarang_id, penerbit_id, total_books, gambar, sinopsis) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("ssiiiiss", $kode_buku, $judul, $category_id, $pengarang_id, $penerbit_id, $total_books, $gambar_path, $sinopsis);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=buku");
        } else {
            echo "Data Gagal Disimpan" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}





if ($_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $kode_buku = $_POST['kode_buku'];
        $judul = $_POST['judul'];
        $category_id = $_POST['category_id'];
        $pengarang_id = $_POST['pengarang_id'];
        $penerbit_id = $_POST['penerbit_id'];
        $total_books = $_POST['total_books'];
        $sinopsis = $_POST['sinopsis'];

        // Periksa apakah gambar diupload
        $gambar_path = '';
        if (isset($_FILES['gambar']['tmp_name']) && !empty($_FILES['gambar']['tmp_name'])) {
            $gambar_name = $_FILES['gambar']['name'];
            $gambar_tmp = $_FILES['gambar']['tmp_name'];
            
            // Sesuaikan folder tempat gambar disimpan
            $folder_path = "images/";

            // Sesuaikan path gambar dengan nama folder dan nama file
            $gambar_path = $folder_path . $gambar_name;
            
            move_uploaded_file($gambar_tmp, $gambar_path);
        } else {
            // Jika gambar tidak diunggah, gunakan gambar lama dari database
            $queryGetOldImage = "SELECT gambar FROM buku WHERE id=?";
            $stmtGetOldImage = $db->prepare($queryGetOldImage);
            $stmtGetOldImage->bind_param("i", $id);
            $stmtGetOldImage->execute();
            $stmtGetOldImage->store_result();

            $gambarLama = '';
            $stmtGetOldImage->bind_result($gambarLama);
            $stmtGetOldImage->fetch();

            // Set nilai gambar_path dengan gambar lama
            $gambar_path = $gambarLama;

            $stmtGetOldImage->close();
        }

        // Query UPDATE dengan penanganan nilai gambar
        $query = "UPDATE buku SET kode_buku=?, judul=?, category_id=?, pengarang_id=?, penerbit_id=?, total_books=?, gambar=?, sinopsis=? WHERE id=?";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bind_param("ssiiiissi", $kode_buku, $judul, $category_id, $pengarang_id, $penerbit_id, $total_books, $gambar_path, $sinopsis, $id);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: index.php?page=buku");
        } else {
            echo "Data Gagal Diupdate" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}



if($_GET['proses']=='delete') {
    //query delete
    
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM buku WHERE id='$id'";

    if ($db->query($sql) == TRUE) {
        Header("Location: index.php?page=buku");
    } else {
        echo "Gagal Update!" . $db->error;
    }
    
} else {
    echo "ID TIDAK DITEMUKAN!";
}
}

?>