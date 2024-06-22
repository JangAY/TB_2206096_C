<?php
include 'config.php';

$nama_agenda = "";
$jumlah_pemasukan = "";
$waktu_pemasukan = "";
$bayar = "";
$tanggal_pemasukan = "";
$nohp = "";
$sukses = "";
$error = "";
$id_p = "";
$ket_pemasukan = "";
$id = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = '';
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM pemasukan WHERE kode_pemasukan = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1 && mysqli_num_rows($q1) > 0) {
        $r1 = mysqli_fetch_array($q1);
        $id = $r1["kode_pemasukan"];
        $jumlah_pemasukan = $r1["jumlah_pemasukan"];
        $tanggal_pemasukan = $r1["tanggal_pemasukan"];
        $ket_pemasukan = $r1["ket_pemasukan"];
        $waktu_pemasukan = $r1["waktu_pemasukan"];
    } else {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $jumlah_pemasukan = $_POST['jumlah_pemasukan'];
    $tanggal_pemasukan = $_POST['tanggal_pemasukan'];
    $ket_pemasukan = $_POST['ket_pemasukan'];
    $waktu_pemasukan = $_POST['waktu_pemasukan'];

    if ($jumlah_pemasukan && $tanggal_pemasukan && $ket_pemasukan && $waktu_pemasukan) {
        if ($op == 'edit') {
            $sql1 = "UPDATE pemasukan SET kode_pemasukan='$id', jumlah_pemasukan='$jumlah_pemasukan', tanggal_pemasukan='$tanggal_pemasukan', waktu_pemasukan ='$waktu_pemasukan', ket_pemasukan='$ket_pemasukan'  WHERE kode_pemasukan='$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diperbarui";
            } else {
                $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
            }
        } else {
            $sql1 = "INSERT INTO pemasukan (kode_pemasukan, jumlah_pemasukan, tanggal_pemasukan, ket_pemasukan, waktu_pemasukan) VALUES ('$id', '$jumlah_pemasukan', '$tanggal_pemasukan', '$waktu_pemasukan', '$ket_pemasukan')";
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
    $sql1 = "DELETE FROM pemasukan WHERE kode_pemasukan = '$id'";
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
                        <label for="jumlah_pemasukan" class="col-sm-2 col-form-label">Jumlah Pemasukan</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="jumlah_pemasukan" id="jumlah_pemasukan"
                                value="<?php echo $jumlah_pemasukan ?>">
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="tanggal_pemasukan" class="col-sm-2 col-form-label">tanggal agenda</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="tanggal_pemasukan" id="tanggal_pemasukan"
                                value="<?php echo $tanggal_pemasukan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="waktu_pemasukan" class="col-sm-2 col-form-label">Waktu Pemasukan</label>
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="waktu_pemasukan" id="waktu_pemasukan"
                                value="<?php echo $waktu_pemasukan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="ket_pemasukan" class="col-sm-2 col-form-label">keterangan pemasukan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ket_pemasukan" id="ket_pemasukan"
                                value="<?php echo $ket_pemasukan ?>">
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
                Data Pemasukan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kode Pemasukan</th>
                            <th scope="col">Jumlah Pemasukan</th>
                            <th scope="col">Tanggal Pemasukan</th>
                            <th scope="col">Waktu Pemasukan</th>
                            <th scope="col">ket_pemasukan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM pemasukan ORDER BY kode_pemasukan DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['kode_pemasukan'];
                            $jumlah_pemasukan = $r2['jumlah_pemasukan'];
                            $tanggal_pemasukan = $r2['tanggal_pemasukan'];
                            $waktu_pemasukan = $r2['waktu_pemasukan'];
                            $ket_pemasukan = $r2['ket_pemasukan'];
                            ?>
                            <tr>
                                <td><?php echo $id ?></td>
                                <td><?php echo $jumlah_pemasukan ?></td>
                                <td><?php echo $tanggal_pemasukan ?></td>
                                <td><?php echo $waktu_pemasukan ?></td>
                                <td><?php echo $ket_pemasukan ?></td>
                                <td>
                                    <a href="Pemasukan.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                            class="btn btn-danger">Edit</button></a>
                                    <a href="Pemasukan.php?op=delete&id=<?php echo $id ?>"
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