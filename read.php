<!DOCTYPE html>
<html lang="en">
include ="config.php";
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
                            </tr>
                        <tbody>
                            <?php
                                            $sql2 = "select * from donatur order by id DESC";
                                            $q2 = mysqli_query($koneksi, $sql2);
                                            $urut = 1;
                                            while ($r2 = mysqli_fetch_array($q2)) {
                                                $id         = $r2 ['id'];
                                                $nama       = $r2['nama'];
                                                $alamat     = $r2['alamat'];
                                                $jk         = $r2['JK'];
                                                $bayar      = $r2['bayar'];
                                                $tanggal    = $r2['tanggal'];
                                                $nohp       = $r2['nohp'];
                                                $id_p       = $r2['id_p'];


                                                ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <th scope="row"><?php echo $nama ?></th>
                                <th scope="row"><?php echo $alamat ?></th>
                                <th scope="row"><?php echo $jk ?></th>
                                <th scope="row"><?php echo $bayar ?></th>
                                <th scope="row"><?php echo $tanggal ?></th>
                                <th scope="row"><?php echo $nohp ?></th>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                            class="btn btn-danger">Edit</button></a>

                                    <button type="button" class="btn btn-warning">Delete</button>
                                </td>
                            </tr>
                            <?php
                                            }

                                            ?>
                    </tbody>
                    </thead>
                </table>


                </form>
            </div>
</body>

</html> 