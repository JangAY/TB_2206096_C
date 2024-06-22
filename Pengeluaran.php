<?php
include 'config.php';

$nama_agenda = "";
$jumlah_pengeluaran = "";
$waktu_pengeluaran = "";
$bayar = "";
$tanggal_pengeluaran = "";
$nohp = "";
$sukses = "";
$error = "";
$id_p = "";
$nama_pengeluaran = "";
$id = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = '';
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM pengeluaran WHERE kode_pengeluaran = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1 && mysqli_num_rows($q1) > 0) {
        $r1 = mysqli_fetch_array($q1);
        $id = $r1["kode_pengeluaran"];
        $jumlah_pengeluaran = $r1["jumlah_pengeluaran"];
        $tanggal_pengeluaran = $r1["tanggal_pengeluaran"];
        $nama_pengeluaran = $r1["nama_pengeluaran"];
        $waktu_pengeluaran = $r1["waktu_pengeluaran"];
    } else {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $id = $_POST['kode_pengeluaran'];
    $jumlah_pengeluaran = $_POST['jumlah_pengeluaran'];
    $tanggal_pengeluaran = $_POST['tanggal_pengeluaran'];
    $nama_pengeluaran = $_POST['nama_pengeluaran'];
    $waktu_pengeluaran = $_POST['waktu_pengeluaran'];

    if ($jumlah_pengeluaran && $tanggal_pengeluaran && $nama_pengeluaran && $waktu_pengeluaran) {
        if ($op == 'edit') {
            $sql1 = "UPDATE pengeluaran SET kode_pengeluaran='$id', jumlah_pengeluaran='$jumlah_pengeluaran', tanggal_pengeluaran='$tanggal_pengeluaran', nama_pengeluaran='$nama_pengeluaran', waktu_pengeluaran ='$waktu_pengeluaran' WHERE kode_pengeluaran='$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diperbarui";
            } else {
                $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
            }
        } else {
            $sql1 = "INSERT INTO pengeluaran (kode_pengeluaran, jumlah_pengeluaran, tanggal_pengeluaran, nama_pengeluaran, waktu_pengeluaran) VALUES ('$id', '$jumlah_pengeluaran', '$tanggal_pengeluaran', '$waktu_pengeluaran'), '$nama_pengeluaran'";
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
    $sql1 = "DELETE FROM pengeluaran WHERE kode_pengeluaran = '$id'";
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
                        <label for="Kode_pengeluaran" class="col-sm-2 col-form-label">kode pengeluaran</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="kode_pengeluaran" id="kode_pengeluaran"
                                value="<?php echo $id ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jumlah_pengeluaran" class="col-sm-2 col-form-label">Jumlah pengeluaran</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="jumlah_pengeluaran" id="jumlah_pengeluaran"
                                value="<?php echo $jumlah_pengeluaran ?>">
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="tanggal_pengeluaran" class="col-sm-2 col-form-label">tanggal agenda</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_pengeluaran" id="tanggal_pengeluaran"
                                value="<?php echo $tanggal_pengeluaran ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="waktu_pengeluaran" class="col-sm-2 col-form-label">Waktu pengeluaran</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="waktu_pengeluaran" id="waktu_pengeluaran"
                                value="<?php echo $waktu_pengeluaran ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_pengeluaran" class="col-sm-2 col-form-label">keterangan pengeluaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_pengeluaran" id="nama_pengeluaran"
                                value="<?php echo $nama_pengeluaran ?>">
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
                Data pengeluaran
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kode pengeluaran</th>
                            <th scope="col">Jumlah pengeluaran</th>
                            <th scope="col">Tanggal pengeluaran</th>
                            <th scope="col">Waktu pengeluaran</th>
                            <th scope="col">nama_pengeluaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM pengeluaran ORDER BY kode_pengeluaran DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['kode_pengeluaran'];
                            $jumlah_pengeluaran = $r2['jumlah_pengeluaran'];
                            $tanggal_pengeluaran = $r2['tanggal_pengeluaran'];
                            $waktu_pengeluaran = $r2['waktu_pengeluaran'];
                            $nama_pengeluaran = $r2['nama_pengeluaran'];
                            ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $jumlah_pengeluaran ?></td>
                                <td><?php echo $tanggal_pengeluaran ?></td>
                                <td><?php echo $waktu_pengeluaran ?></td>
                                <td><?php echo $nama_pengeluaran ?></td>
                                <td>
                                    <a href="pengeluaran.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                            class="btn btn-danger">Edit</button></a>
                                    <a href="pengeluaran.php?op=delete&id=<?php echo $id ?>"
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