<?php
include 'config.php';

$nama = "";
$alamat = "";
$jk = "";
$jumlah_donasi = '';
$tanggal = "";
$nohp = "";
$sukses = "";
$error = "";
$id_p = "";
$id = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = '';
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM donatur WHERE id_donatur = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1 && mysqli_num_rows($q1) > 0) {
        $r1 = mysqli_fetch_array($q1);
        $nama = $r1["nama_donatur"];
        $alamat = $r1["alamat_donatur"];
        $jk = $r1["jenis_kelamin"];
        $jumlah_donasi = $r1["jumlah_donasi"];
        $tanggal = $r1["tanggal_donasi"];
        $nohp = $r1["no_hp_donatur"];
        $id_p = $r1["id_petugas"];
    } else {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['JK'];
    $jumlah_donasi = $_POST['jumlah_donasi'];
    $tanggal = $_POST['tanggal'];
    $nohp = $_POST['nohp'];
    $id_p = $_POST['id_p'];

    if ($nama && $alamat && $jk && $jumlah_donasi && $tanggal && $nohp && $id_p) {
        if ($op == 'edit') {
            $sql1 = "UPDATE donatur SET nama_donatur='$nama', alamat_donatur='$alamat', jenis_kelamin='$jk', jumlah_donasi='$jumlah_donasi', tanggal_donasi='$tanggal', no_hp_donatur='$nohp', id_petugas='$id_p' WHERE id_donatur='$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diperbarui";
            } else {
                $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
            }
        } else {
            $sql1 = "INSERT INTO donatur (nama_donatur, alamat_donatur, jenis_kelamin, jumlah_donasi, tanggal_donasi, no_hp_donatur, id_petugas) VALUES ('$nama', '$alamat', '$jk', '$jumlah_donasi', '$tanggal', '$nohp', '$id_p')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data: " . mysqli_error($koneksi);
            }
        }
    } else {
        $error = "Silahkan masukkan semua data kembali";
    }
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM donatur WHERE id_donatur = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil menghapus data";
    } else {
        $error = "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD DATABASE KELOMPOK 7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px
        }
    </style>

</head>

<body>
<nav>
        <div class="container">
            <img src="images/logo.png" alt="Logo" class="logo">
            <ul class="nav-links">
                <li><a href="DataDonatur.php">Data Donatur</a></li>
                <li><a href="DataAgenda.php">Data Agenda</a></li>
                <li><a href="Pemasukan.php">Pemasukan</a></li>
                <li><a href="pengeluaran.php">Pengeluaran</a></li>
            </ul>
        </div>
    </nav>

    <!-- Memasukkan data -->
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php
                }
                ?>
                <?php
                if ($sukses) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php
                }
                ?>

                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="JK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="JK" id="JK">
                                <option value="">- Jenis Kelamin -</option>
                                <option value="Laki-Laki" <?php if ($jk == "Laki-Laki") echo "selected" ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if ($jk == "Perempuan") echo "selected" ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jumlah_donasi" class="col-sm-2 col-form-label">Donasi</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="jumlah_donasi" id="jumlah_donasi" value="<?php echo $jumlah_donasi ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?php echo $tanggal ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nohp" class="col-sm-2 col-form-label">NO HP</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="nohp" id="nohp" value="<?php echo $nohp ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="id_p" class="col-sm-2 col-form-label">Petugas</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_p" id="id_p">
                                <option value="">- Petugas -</option>
                                <option value="1061" <?php if ($id_p == "1061") echo "selected" ?>>Nazham</option>
                                <option value="1062" <?php if ($id_p == "1062") echo "selected" ?>>Rina</option>
                                <option value="1063" <?php if ($id_p == "1063") echo "selected" ?>>Al-Ghifari</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- Mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Donatur
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Jumlah Donasi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">No HP</th>
                            <th scope="col">ID Petugas</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM donatur ORDER BY id_donatur DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id_donatur'];
                            $nama = $r2['nama_donatur'];
                            $alamat = $r2['alamat_donatur'];
                            $jk = $r2['jenis_kelamin'];
                            $jumlah_donasi = $r2['jumlah_donasi'];
                            $tanggal = $r2['tanggal_donasi'];
                            $nohp = $r2['no_hp_donatur'];
                            $id_p = $r2['id_petugas'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td><?php echo $nama ?></td>
                                <td><?php echo $alamat ?></td>
                                <td><?php echo $jk ?></td>
                                <td><?php echo $jumlah_donasi ?></td>
                                <td><?php echo $tanggal ?></td>
                                <td><?php echo $nohp ?></td>
                                <td><?php echo $id_p ?></td>
                                <td>
                                    <a href="datadonatur.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-danger">Edit</button></a>
                                    <a href="datadonatur.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><button type="button" class="btn btn-warning">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>