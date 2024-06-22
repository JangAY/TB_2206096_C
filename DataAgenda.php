<?php
include 'config.php';

$nama_agenda = "";
$tempat_agenda = "";
$waktu_agenda = "";
$bayar = "";
$tanggal_agenda = "";
$nohp = "";
$sukses = "";
$error = "";
$id_p = "";
$keterangan = "";
$id = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = '';
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM agenda WHERE kode_agenda = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1 && mysqli_num_rows($q1) > 0) {
        $r1 = mysqli_fetch_array($q1);
        $nama_agenda = $r1["nama_agenda"];
        $tempat_agenda = $r1["tempat_agenda"];
        $tanggal_agenda = $r1["tanggal_agenda"];
        $keterangan = $r1["keterangan"];
        $waktu_agenda = $r1["waktu_agenda"];
        $id_p = $r1["id_p"];
    } else {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_agenda = $_POST['nama_agenda'];
    $tempat_agenda = $_POST['tempat_agenda'];
    $tanggal_agenda = $_POST['tanggal_agenda'];
    $waktu_agenda = $_POST['waktu_agenda'];
    $keterangan = $_POST['keterangan'];
    $id_p = $_POST['id_p'];


    if ($nama_agenda && $tempat_agenda && $tanggal_agenda && $keterangan && $waktu_agenda && $id_p) {
        if ($op == 'edit') {
            $sql1 = "UPDATE agenda SET kode_agenda='$id', nama_agenda='$nama_agenda', tempat_agenda='$tempat_agenda', tanggal_agenda='$tanggal_agenda', keterangan='$keterangan' , waktu_agenda='$waktu_agenda' WHERE kode_agenda='$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diperbarui";
            } else {
                $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
            }
        } else {
            $sql1 = "INSERT INTO agenda (nama_agenda, tempat_agenda, tanggal_agenda, waktu_agenda, keterangan, id_petugas) VALUES ('$nama_agenda', '$tempat_agenda', '$tanggal_agenda', '$waktu_agenda', '$keterangan', '$id_p')";
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
    $sql1 = "DELETE FROM agenda WHERE kode_agenda = '$id'";
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
    <a href="DataAgenda.php?op=tambah&id=<?php echo $id ?>"><button type="button" class="btn btn-danger"></button></a>

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
                        <label for="nama_agenda" class="col-sm-2 col-form-label">nama agenda</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_agenda" id="nama_agenda"
                                value="<?php echo $nama_agenda ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tempat_agenda" class="col-sm-2 col-form-label">tempat agenda</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tempat_agenda" id="tempat_agenda"
                                value="<?php echo $tempat_agenda ?>">
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="tanggal_agenda" class="col-sm-2 col-form-label">tanggal agenda</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_agenda" id="tanggal_agenda"
                                value="<?php echo $tanggal_agenda ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="waktu_agenda" class="col-sm-2 col-form-label">Waktu Agenda</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="waktu_agenda" id="waktu_agenda"
                                value="<?php echo $waktu_agenda ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="keterangan" id="keterangan"
                                value="<?php echo $keterangan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="id_p" class="col-sm-2 col-form-label">Petugas</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_p" id="id_p">
                                <option value="">- Petugas -</option>
                                <option value="1061" <?php if ($id_p == "1061")
                                    echo "selected" ?>>Nazham</option>
                                    <option value="1062" <?php if ($id_p == "1062")
                                    echo "selected" ?>>Rina</option>
                                    <option value="1063" <?php if ($id_p == "1063")
                                    echo "selected" ?>>Al-Ghifari</option>
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
                    Data agenda
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode Agenda</th>
                                <th scope="col">Nama Agenda</th>
                                <th scope="col">Tempat Agenda</th>
                                <th scope="col">tanggal Agenda</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">ID Petugas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql2 = "SELECT * FROM agenda ORDER BY kode_agenda DESC";
                                $q2 = mysqli_query($koneksi, $sql2);
                                $urut = 1;
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id = $r2['kode_agenda'];
                                    $nama_agenda = $r2['nama_agenda'];
                                    $tempat_agenda = $r2['tempat_agenda'];
                                    $tanggal_agenda = $r2['tanggal_agenda'];
                                    $keterangan = $r2['keterangan'];
                                    ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td><?php echo $nama_agenda ?></td>
                                <td><?php echo $tempat_agenda ?></td>
                                <td><?php echo $tanggal_agenda ?></td>
                                <td><?php echo $keterangan ?></td>
                                <td><?php echo $waktu_agenda ?></td>
                                <td><?php echo $id_p ?></td>
                                <td>
                            
                                    <a href="DataAgenda.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                            class="btn btn-danger">Edit</button></a>
                                    <a href="DataAgenda.php?op=delete&id=<?php echo $id ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><button
                                            type="button" class="btn btn-warning">Delete</button></a>
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