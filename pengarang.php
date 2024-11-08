<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
        <h1 class="text-center">List Pengarang</h1>
        <table class="table table-striped" id="example">
            <thead>
                <tr>
                    <th style="background-color: salmon;">No</th>
                    <th style="background-color: salmon;">Nama Pengarang</th>
                    <th style="background-color: salmon;">Keterangan</th>
                    <th style="background-color: salmon;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM pengarang order by id_pengarang";
                $result = $db->query($query);
                $nomor = 1;
                foreach ($result as $row) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $row['nama_pengarang'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td class="action-buttons" style="white-space: nowrap;">
                            <a href="?page=pengarang&aksi=edit&id=<?= $row['id_pengarang'] ?>" class="btn btn-success" >Edit</a>
                            <a onclick="return confirm('Are you sure want to delete?')" href="proses_pengarang.php?proses=delete&id=<?= $row['id_pengarang'] ?>" class="btn btn-danger" style="margin-right: 10px;">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <p class="text-center mt-4">Untuk input data silahkan <a href="?page=pengarang&aksi=input" class="btn btn-primary">KLIK DI SINI</a></p>





<?php
        break;
    case 'input':
?>
        <h1 class="mb-4">Input Pengarang</h1>
        <a href="index.php?page=pengarang&aksi=list" class="btn btn-primary mb-4">List Pengarang</a>

        <form action="proses_pengarang.php?proses=insert" method="post">
            <div class="mb-3 row">
                <label for="nama_pengarang" class="col-sm-2 col-form-label">Nama Pengarang</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_pengarang" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <textarea name="keterangan" class="form-control" rows="5" required></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <input type="submit" name="submit" class="btn btn-success">
                </div>
            </div>
        </form>


        

<?php
        break;
    case 'edit':
        if (isset($_GET['id'])) {
            $id_pengarang = $_GET['id'];
            $query = "SELECT * FROM pengarang WHERE id_pengarang='$id_pengarang'";
            $result = $db->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nama_pengarang = $row['nama_pengarang'];
                $keterangan = $row['keterangan'];
            } else {
                echo "Data dengan ID pengarang" . $id_pengarang . " Tidak Ditemukan!";
                exit;
            }
        } else {
            echo "Parameter tidak valid!";
            exit;
        }
?>

        <h1>Edit Pengarang</h1>
        <a href="index.php?page=pengarang&aksi=list" class="btn btn-primary">List Pengarang</a><br><br>
        <form action="proses_pengarang.php?proses=update" method="post">
            <input type="hidden" name="id_pengarang" value="<?= $id_pengarang ?>">
            <div class="mb-3 row">
                <label for="nama_pengarang" class="col-sm-2 col-form-label">Nama Pengarang</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_pengarang" value="<?= $nama_pengarang ?>" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <textarea name="keterangan" class="form-control" rows="5" required><?= $keterangan ?></textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <input type="submit" name="submit" class="btn btn-success">
                </div>
            </div>
        </form>

<?php
        break;
}
?>
