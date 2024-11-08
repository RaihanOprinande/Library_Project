<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
        <h1 class="text-center">List Kategori</h1>
        <table class="table table-striped" id="example">
            <thead>
                <tr>
                    <th style="background-color: salmon;">No</th>
                    <th style="background-color: salmon;">Nama Kategori</th>
                    <th style="background-color: salmon;">Keterangan</th>
                    <th style="background-color: salmon;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM kategori order by id_kategori";
                $result = $db->query($query);
                $nomor = 1;
                foreach ($result as $row) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $row['nama_kategori'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td class="action-buttons" style="white-space: nowrap;">
                            <a href="?page=kategori&aksi=edit&id=<?= $row['id_kategori'] ?>" class="btn btn-success" >Edit</a>
                            <a onclick="return confirm('Are you sure want to delete?')" href="proses_kategori.php?proses=delete&id=<?= $row['id_kategori'] ?>" class="btn btn-danger" style="margin-right: 10px;">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <p class="text-center mt-4">Untuk input data silahkan <a href="?page=kategori&aksi=input" class="btn btn-primary">KLIK DI SINI</a></p>





<?php
        break;
    case 'input':
?>
        <h1 class="mb-4">Input Kategori</h1>
        <a href="index.php?page=kategori&aksi=list" class="btn btn-primary mb-4">List Kategori</a>

        <form action="proses_kategori.php?proses=insert" method="post">
            <div class="mb-3 row">
                <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_kategori" class="form-control" required>
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
            $id_kategori = $_GET['id'];
            $query = "SELECT * FROM kategori WHERE id_kategori='$id_kategori'";
            $result = $db->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nama_kategori = $row['nama_kategori'];
                $keterangan = $row['keterangan'];
            } else {
                echo "Data dengan ID Kategori " . $id_kategori . " Tidak Ditemukan!";
                exit;
            }
        } else {
            echo "Parameter tidak valid!";
            exit;
        }
?>

        <h1>Edit Kategori</h1>
        <a href="index.php?page=kategori&aksi=list" class="btn btn-primary">List Kategori</a><br><br>
        <form action="proses_kategori.php?proses=update" method="post">
            <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>">
            <div class="mb-3 row">
                <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_kategori" value="<?= $nama_kategori ?>" class="form-control" required>
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
