<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
        
<h1 class="text-center">List Staff</h1>
<table class="table table-striped" id="example">
    <thead>
        <tr>
            <th style="background-color: salmon;">No</th>
            <th style="background-color: salmon;">Nama Staff</th>
            <th style="background-color: salmon;">Email</th>
            <th style="background-color: salmon;">Foto</th>
            <th style="background-color: salmon;">Status Staff</th>
            <th style="background-color: salmon;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM staff";
        $result = $db->query($query);
        $nomor = 1;
        foreach ($result as $row) : ?>
            <tr>
                <td><?= $nomor++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><img src="<?= $row['foto'] ?>" alt="Foto Staff" style="width: 150px;"></td>
                <td><?= $row['level'] ?></td>
                <td class="action-buttons" style="white-space: nowrap;">
                    <!-- Add/Edit/Delete links with appropriate parameters -->
                    <a href="?page=staff&aksi=edit&id=<?= $row['id'] ?>" class="btn btn-success">Edit</a>
                    <a onclick="return confirm('Are you sure want to delete?')" href="proses_staff.php?proses=delete&id=<?= $row['id'] ?>" class="btn btn-danger" style="margin-right: 10px;">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php
if ($_SESSION['level'] == 'admin') {
?>
    <p class="text-center mt-4">Untuk input data silahkan <a href="?page=staff&aksi=input" class="btn btn-primary">KLIK DI SINI</a></p>
<?php
}
?>



<?php
    break;
    case 'input':

?>

<h1 class="mb-4">Input Staff</h1>
<a href="index.php?page=staff&aksi=list" class="btn btn-primary mb-4">List Staff</a>

<form action="proses_staff.php?proses=insert" method="post" enctype="multipart/form-data">
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" name="nama" class="form-control" required>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" name="email" class="form-control" required>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
        <div class="col-sm-10">
            <input type="file" name="foto" accept="image/*" class="form-control-file" required>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" name="password" class="form-control" required>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="level" class="col-sm-2 col-form-label">Status Staff</label>
        <div class="col-sm-10">
            <select name="level" class="form-control" required>
                <option value="Admin">Admin</option>
                <option value="Pustakawan">Pustakawan</option>
            </select>
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
            $id = $_GET['id'];
            $query = "SELECT * FROM staff WHERE id='$id'";
            $result = $db->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nama = $row['nama'];
                $email = $row['email'];
                $password =  $row['password'];
                $level = $row['level'];
                $foto = $row['foto'];

            } else {
                echo "Data dengan ID ".$id." Tidak Ditemukan!";
                exit;
            }
        } else {
            echo "Parameter tidak valid!";
            exit;
        }
?>

<h1>Edit Staff</h1>
<a href="index.php?page=staff&aksi=list" class="btn btn-primary">List Staff</a><br><br>
<form action="proses_staff.php?proses=update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=$id?>">
    <table class="table table-borderless">
        <tr>
            <td>nama</td>
            <td><input type="text" name="nama" value="<?=$nama?>"class="form-control" required></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?=$email?>" class="form-control" required></td>
        </tr>


        <tr>
            <td>Foto</td>
            <td>
                <input type="file" name="foto" accept="image/*" class="form-control-file">
                <img src="<?=$foto?>" alt="Foto Staff" style="width: 150px;">
            </td>
        </tr>

        <tr>
            <td>Password</td>
            <td><input type="password" name="password" value="<?=$password?>" class="form-control" required></td>
        </tr>

        <tr>
            <td>Status Staff</td>
            <td>
                <select name="level" class="form-control" required>
                    <option value="Admin" <?= ($level == 'Admin') ? 'selected' : '' ?>>Admin</option>
                    <option value="Pustakawan" <?= ($level == 'Pustakawan') ? 'selected' : '' ?>>Pustakawan</option>
                </select>
            </td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submit" class="btn btn-success"></td>
        </tr>
    </table>
</form>


<?php
    break;
}
?>
